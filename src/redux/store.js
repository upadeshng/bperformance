import { createStore, applyMiddleware } from 'redux'
import { composeWithDevTools } from 'redux-devtools-extension'

import thunk from 'redux-thunk'
import combineReducer from './combineReducer'

const composeEnhancers = composeWithDevTools({
  trace: true,
  traceLimit: 25,
})

export default createStore(combineReducer, composeEnhancers(applyMiddleware(thunk)))
