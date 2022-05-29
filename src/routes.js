import React from 'react'
const StudentList = React.lazy(() => import('./views/student/List'))
const StudentAdd = React.lazy(() => import('./views/student/Add'))
const StudentUpdate = React.lazy(() => import('./views/student/Update'))
const StudentView = React.lazy(() => import('./views/student/View'))

const routes = [
  { path: '/', exact: true, name: 'Home' },
  { path: '/student', name: 'Students', element: StudentList },
  { path: '/student/add', name: 'Student Add', element: StudentAdd },
  { path: '/student/update/:id', name: 'Student Update', element: StudentUpdate },
  { path: '/student/view/:id', name: 'Student Update', element: StudentView },
]

export default routes
