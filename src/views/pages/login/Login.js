import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import {
  CButton,
  CCard,
  CCardBody,
  CCardGroup,
  CCol,
  CContainer,
  CForm,
  CFormFeedback,
  CFormInput,
  CInputGroup,
  CInputGroupText,
  CRow,
  CAlert,
} from '@coreui/react'
import CIcon from '@coreui/icons-react'
import { cilLockLocked, cilUser } from '@coreui/icons'
import { login } from 'src/redux/action/account'
import { useNavigate } from 'react-router-dom'

const Login = () => {
  let dispatch = useDispatch()
  let navigate = useNavigate()
  const [state, setState] = useState({
    username: '9842998058',
    password: '9842998058',
    errorMessage: '',
  })
  const [validated, setValidated] = useState(false)
  const { username, password, errorMessage } = state
  const { loginAccount } = useSelector((state) => state.accountReducer)
  const handleInputChange = (e) => {
    let { name, value, errorMessage } = e.target
    setState({ ...state, [name]: value })
  }
  useEffect(() => {
    console.log('loginAccountloginAccount', loginAccount)
    if (loginAccount.status === '') {
      setState({ ...state, ['errorMessage']: loginAccount.message })
      console.log('errrrrr')
    }
  }, [loginAccount])

  const handleSubmit = (e) => {
    e.preventDefault()
    const form = e.currentTarget
    const validated = form.checkValidity()
    if (validated === false) {
      e.stopPropagation()
    } else {
      dispatch(login(state, navigate))
    }
    setValidated(true)
  }

  return (
    <div className="bg-light min-vh-100 d-flex flex-row align-items-center">
      <CContainer>
        <CRow className="justify-content-center">
          <CCol md={5}>
            <CCardGroup>
              <CCard className="p-4">
                <CCardBody>
                  {errorMessage && <CAlert color="danger">{errorMessage}!</CAlert>}
                  <CForm
                    className="g-3 needs-validation"
                    noValidate
                    validated={validated}
                    onSubmit={handleSubmit}
                  >
                    <h1>Login</h1>
                    <p className="text-medium-emphasis">Sign In to your account</p>
                    <CInputGroup className="mb-3">
                      <CInputGroupText>
                        <CIcon icon={cilUser} />
                      </CInputGroupText>
                      <CFormInput
                        name="username"
                        value={username}
                        onChange={handleInputChange}
                        placeholder="Username"
                        autoComplete="username"
                        required
                      />
                      <CFormFeedback invalid>Please fill Username.</CFormFeedback>
                    </CInputGroup>
                    <CInputGroup className="mb-4">
                      <CInputGroupText>
                        <CIcon icon={cilLockLocked} />
                      </CInputGroupText>
                      <CFormInput
                        type="password"
                        name="password"
                        value={password}
                        onChange={handleInputChange}
                        placeholder="Password"
                        autoComplete="current-password"
                        required
                      />
                      <CFormFeedback invalid>Please fill Password.</CFormFeedback>
                    </CInputGroup>
                    <CRow>
                      <CCol xs={6}>
                        <CButton color="primary" className="px-4" type="submit">
                          Login
                        </CButton>
                      </CCol>
                    </CRow>
                  </CForm>
                </CCardBody>
              </CCard>
            </CCardGroup>
          </CCol>
        </CRow>
      </CContainer>
    </div>
  )
}

export default Login
