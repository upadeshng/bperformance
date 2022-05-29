import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import {
  CButton,
  CCard,
  CCardBody,
  CCardHeader,
  CCol,
  CForm,
  CFormFeedback,
  CFormInput,
  CFormLabel,
  CRow,
} from '@coreui/react'
import DatePicker from 'react-datepicker'
import 'react-datepicker/dist/react-datepicker.css'
import { getStudent, updateStudent } from 'src/redux/action/student'
import { useNavigate, useParams } from 'react-router-dom'
import moment from 'moment'

const FormControl = () => {
  let dispatch = useDispatch()
  let navigate = useNavigate()
  let { id } = useParams()
  const { student } = useSelector((state) => state.studentReducer)
  const [validated, setValidated] = useState(false)
  const [state, setState] = useState({
    firstName: '',
    lastName: '',
    email: '',
    dob: '',
  })
  const { firstName, lastName, email, dob } = state

  useEffect(() => {
    dispatch(getStudent(id))
  }, [])

  useEffect(() => {
    if (student.item) {
      let data = student.item
      if (student.item.dob) {
        data.dob = new Date(moment(student.item.dob))
      } else {
        data.dob = ''
      }
      setState({ ...data })
    }
  }, [student])

  const handleDobChange = (e) => {
    setState({ ...state, ['dob']: e })
  }

  const handleInputChange = (e) => {
    let { name, value } = e.target
    setState({ ...state, [name]: value })
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    const form = e.currentTarget
    const validated = form.checkValidity()
    if (validated === false) {
      e.stopPropagation()
    } else {
      dispatch(updateStudent(id, state, navigate))
    }
    setValidated(true)
  }
  return (
    <CRow>
      <CCol xs={12}>
        <CCard className="mb-4">
          <CCardHeader>
            <strong>Update Student</strong>
          </CCardHeader>
          <CCardBody>
            <CForm
              className="g-3 needs-validation"
              noValidate
              validated={validated}
              onSubmit={handleSubmit}
            >
              <CCol md={3} className="mb-3">
                <CFormLabel htmlFor="firstNameInput">First Name</CFormLabel>
                <CFormInput
                  type="text"
                  name="firstName"
                  value={firstName}
                  onChange={handleInputChange}
                  id="firstNameInput"
                  placeholder="First name"
                  required
                />
                <CFormFeedback invalid>Please fill First name.</CFormFeedback>
              </CCol>
              <CCol md={3} className="mb-3">
                <CFormLabel htmlFor="lastNameInput">Last Name</CFormLabel>
                <CFormInput
                  type="text"
                  name="lastName"
                  value={lastName}
                  onChange={handleInputChange}
                  id="lastNameInput"
                  placeholder="Last name"
                  required
                />
                <CFormFeedback invalid>Please fill Last name.</CFormFeedback>
              </CCol>
              <CCol md={3} className="mb-3">
                <CFormLabel htmlFor="emailInput">Email address</CFormLabel>
                <CFormInput
                  type="email"
                  name="email"
                  value={email}
                  onChange={handleInputChange}
                  id="emailInput"
                  placeholder="name@example.com"
                  required
                />
                <CFormFeedback invalid>Please fill valid email.</CFormFeedback>
              </CCol>
              <CCol md={3} className="mb-3">
                <CFormLabel htmlFor="dobInput">DOB</CFormLabel>
                <DatePicker
                  selected={dob}
                  className="form-control"
                  name="dob"
                  id="dobInput"
                  placeholderText="Date of birth"
                  showYearDropdown
                  autoComplete="off"
                  onChange={handleDobChange}
                  maxDate={new Date()}
                />
              </CCol>
              <CCol xs={12}>
                <CButton color="primary" type="submit">
                  Update
                </CButton>
              </CCol>
            </CForm>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  )
}

export default FormControl
