import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import { useNavigate } from 'react-router-dom'
import { getAllStudent } from 'src/redux/action/student'
import StudentList from './Table'
import { CButton, CCard, CCardHeader, CCardBody, CSpinner } from '@coreui/react'
import CIcon from '@coreui/icons-react'
import { cilPlus } from '@coreui/icons'

const List = (props) => {
  let dispatch = useDispatch()
  let navigate = useNavigate()
  const { studentListing } = useSelector((state) => state.studentReducer)
  useEffect(() => {
    dispatch(getAllStudent())
  }, [])
  const goAddStudent = () => {
    navigate('/student/add')
  }
  if (!studentListing.items) return <CSpinner />

  return (
    <>
      <CCard className="mb-4">
        <CCardHeader>
          <strong>All Students</strong>
          <CButton
            component="a"
            color="dark"
            onClick={goAddStudent}
            role="button"
            size="sm"
            className="float-end"
          >
            <CIcon icon={cilPlus} />
            Add New
          </CButton>
        </CCardHeader>
        <CCardBody>
          <StudentList studentListing={studentListing.items} />
        </CCardBody>
      </CCard>
    </>
  )
}

export default List
