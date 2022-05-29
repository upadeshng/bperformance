import React from 'react'
import { Navigate, Route } from 'react-router-dom'
import PropTypes from 'prop-types'

const ProtectedRoute = ({ children }) => {
  const isLoggedIn = localStorage.getItem('jwt')
  if (!isLoggedIn) {
    return <Navigate to="/login" replace />
  }
  return children
}

ProtectedRoute.propTypes = {
  children: PropTypes.elementType,
}

export default ProtectedRoute
