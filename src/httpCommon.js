import axios from 'axios'

export default axios.create({
  baseURL: '/',
  headers: {
    authorization: `Bearer ${localStorage.getItem('loginToken')}`,
    'Content-Type': 'application/json',
  },
})
