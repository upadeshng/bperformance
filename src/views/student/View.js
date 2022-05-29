import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { CButton, CCard, CCardBody, CCardHeader, CCol, CRow } from '@coreui/react'
import DatePicker from 'react-datepicker'
import 'react-datepicker/dist/react-datepicker.css'
import { getStudent, deleteStudent } from 'src/redux/action/student'
import { useNavigate, useParams } from 'react-router-dom'
import moment from 'moment'

const FormControl = () => {
  let dispatch = useDispatch()
  let navigate = useNavigate()
  let { id } = useParams()
  const { student } = useSelector((state) => state.studentReducer)
  const [state, setState] = useState({
    firstName: '',
    lastName: '',
    email: '',
    dob: '',
    createdAt: '',
  })
  const { firstName, lastName, email, dob, createdAt } = state

  useEffect(() => {
    dispatch(getStudent(id))
  }, [])

  useEffect(() => {
    if (student.item) {
      setState({ ...student.item })
    }
  }, [student])

  const handleDelete = (e, id) => {
    e.preventDefault()
    if (window.confirm('Are you sure you wish to delete it?')) {
      dispatch(deleteStudent(id, navigate))
    }
  }

  return (
    <CRow>
      <CCol xs={12}>
        <CCard className="mb-4">
          <CCardHeader>Student #{id}</CCardHeader>
          <CCardBody>
            <div className="bd-example">
              <dl className="row">
                <dt className="col-sm-2">ID</dt>
                <dd className="col-sm-9">{id}</dd>

                <dt className="col-sm-2">First Name</dt>
                <dd className="col-sm-9">{firstName}</dd>

                <dt className="col-sm-2">Last Name</dt>
                <dd className="col-sm-9">{lastName}</dd>

                <dt className="col-sm-2">DOB</dt>
                <dd className="col-sm-9">{dob}</dd>

                <dt className="col-sm-2">Created At</dt>
                <dd className="col-sm-9">{createdAt}</dd>
              </dl>
            </div>

            <CCol xs={12}>
              <CButton
                variant="outline"
                color="danger"
                onClick={(e) => handleDelete(e, id)}
                className="float-end"
              >
                Delete
              </CButton>
            </CCol>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  )
}

export default FormControl
