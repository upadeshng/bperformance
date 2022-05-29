<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Cache-Control: no-cache');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Accept, Authorization, X-Requested-With');

class StudentController extends Controller
{
    public function actionIndex()
    {
        $data = $this->getAll();
        Common::sendResponse(200, CJSON::encode($data));
        Yii::app()->end();
    }

    public function actionView($id)
    {
        $data = $this->getStudent($id);
        Common::sendResponse(200, CJSON::encode($data));
        Yii::app()->end();
    }

    public function actionAdd()
    {
        Common::validateLoginToken();
        $return_data = $this->addStudent();

        /* response */
        Common::sendResponse(200, CJSON::encode($return_data));
        Yii::app()->end();
    }

    public function actionUpdate($id)
    {
        Common::validateLoginToken();
        $return_data = $this->updateStudent($id);

        Common::sendResponse(200, CJSON::encode($return_data));
        Yii::app()->end();
    }

    public function addStudent()
    {
        $item = new Student();
        return $this->addUpdateStudent($item);
    }

    public function updateStudent($id)
    {
        $item = Student::findById($id);
        return $this->addUpdateStudent($item);
    }

    public function addUpdateStudent($item)
    {
        $body = Yii::app()->request->getRawBody();
        $data = CJSON::decode($body);

        /* posted data */
        $id = isset($data[ 'id' ]) ? $data[ 'id' ] : '';
        $firstName = isset($data[ 'firstName' ]) ? $data[ 'firstName' ] : '';
        $lastName = isset($data[ 'lastName' ]) ? $data[ 'lastName' ] : '';
        $email = isset($data[ 'email' ]) ? $data[ 'email' ] : '';
        $dob = isset($data[ 'dob' ]) && $data[ 'dob' ]
            ? date('Y-m-d', strtotime($data[ 'dob' ])) : null;

        $item->id = $id;
        $item->firstName = $firstName;
        $item->lastName = $lastName;
        $item->email = $email;
        $item->dob = $dob;
        $item->validate();
        $get_errors = $item->getErrors();

        /* return validation error */
        if ($get_errors) {
            $result = 'ERROR';
            $message = $get_errors;

        } else if ($item->save()) {
            $result = 'SUCCESS';
            $message = 'Student record saved successfully!';
        }

        $return_data = [
            'result' => isset($result) ? $result : '',
            'item' => isset($item) ? $item : '',
            'message' => isset($message) ? $message : '',
        ];

        return $return_data;
    }

    public function getAll()
    {
        $model = new Student();
        $data_provider = $model->search();
        $data_provider->setPagination(false);

        $items = [];
        foreach ($data_provider->getData() as $key => $row) {
            $item = $this->getStudentItem($row->id);
            $items [] = $item;
        }

        /* format data */
        $data = [
            'items' => $items,
        ];

        return $data;
    }

    public function getStudent($id)
    {
        $item = $this->getStudentItem($id);
        return [
            'result' => 'SUCCESS',
            'item' => $item
        ];
    }

    public function getStudentItem($id)
    {
        $model = Student::model()->findByPk($id);
        $data = [
            'id' => $model->id,
            'firstName' => $model->firstName,
            'lastName' => $model->lastName,
            'email' => $model->email,
            'dob' => $model->dob,
            'createdAt' => $model->createdAt,
            'updatedAt' => $model->updatedAt,
        ];
        return $data;
    }
}