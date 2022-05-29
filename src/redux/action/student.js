import { GET_ALL_STUDENTS, GET_STUDENT } from './types'
import StudentService from 'src/redux/service/student'

export const getStudent = (id) => async (dispatch) => {
  try {
    const res = await StudentService.get(id)

    dispatch({
      type: GET_STUDENT,
      payload: res.data,
    })
  } catch (err) {
    console.log('error', err)
  }
}

export const getAllStudent = () => async (dispatch) => {
  try {
    const res = await StudentService.getAll()

    dispatch({
      type: GET_ALL_STUDENTS,
      payload: res.data,
    })
  } catch (err) {
    console.log('error', err)
  }
}

export const addStudent = (formData, navigate) => async (dispatch) => {
  try {
    const res = await StudentService.create(formData)

    if (res.data.result === 'SUCCESS') {
      navigate('/student')
    }
  } catch (err) {
    console.log('error', err)
  }
}

export const updateStudent = (id, formData, navigate) => async (dispatch) => {
  try {
    const res = await StudentService.update(id, formData)

    if (res.data.result === 'SUCCESS') {
      navigate('/student')
    }
  } catch (err) {
    console.log('error', err)
  }
}

export const deleteStudent = (id, navigate) => async (dispatch) => {
  try {
    const res = await StudentService.delete(id)

    if (res.data.result === 'SUCCESS') {
      navigate('/student')
    }
  } catch (err) {
    console.log('error', err)
  }
}
