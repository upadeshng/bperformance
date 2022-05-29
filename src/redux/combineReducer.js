import { combineReducers } from 'redux'
import accountReducer from './reducer/account'
import studentReducer from './reducer/student'

export default combineReducers({
  studentReducer: studentReducer,
  accountReducer: accountReducer,
})
