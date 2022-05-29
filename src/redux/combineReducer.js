import { combineReducers } from 'redux'
import accountReducer from './reducer/account'

export default combineReducers({
  accountReducer: accountReducer,
})
