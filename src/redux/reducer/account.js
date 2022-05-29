import { GET_LOGIN_ACCOUNT } from '../action/types'

const initialState = {
  loginAccount: [],
  loading: true,
}

// eslint-disable-next-line import/no-anonymous-default-export
export default (state = initialState, action) => {
  switch (action.type) {
    case GET_LOGIN_ACCOUNT: {
      return {
        ...state,
        loginAccount: action.payload,
        loading: false,
      }
    }
    default: {
      return state
    }
  }
}
