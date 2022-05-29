import { GET_ALL_STUDENTS, GET_STUDENT, ADD_STUDENT } from '../action/types'

const initialState = {
  student: [],
  studentListing: [],
  loading: true,
}

// eslint-disable-next-line import/no-anonymous-default-export
export default (state = initialState, action) => {
  switch (action.type) {
    case ADD_STUDENT: {
      return {
        ...state,
        loading: false,
      }
    }
    case GET_STUDENT: {
      return {
        ...state,
        student: action.payload,
        loading: false,
      }
    }
    case GET_ALL_STUDENTS: {
      return {
        ...state,
        studentListing: action.payload,
        loading: false,
      }
    }
    default: {
      return state
    }
  }
}
