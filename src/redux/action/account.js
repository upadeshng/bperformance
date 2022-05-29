import axios from 'axios'
import { GET_LOGIN_ACCOUNT } from './types'
const API_URL = '/account'

export const login = (formData, navigate) => {
  return function (dispatch) {
    axios.post(`${API_URL}/login`, formData).then((response) => {
      /* store in local storage */
      localStorage.setItem('jwt', response.data)
      localStorage.setItem('loginToken', response.data.token)

      dispatch({ type: GET_LOGIN_ACCOUNT, payload: response.data })

      if (response.data.result === 'SUCCESS') {
        navigate('/student')
      } else {
        console.log('error', response)
      }
    })
  }
}

export const logout = (navigate) => {
  localStorage.removeItem('jwt', null)
  localStorage.removeItem('loginToken', null)
  navigate('/login')
}
