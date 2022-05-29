import React, { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux'
import PropTypes from 'prop-types'
import { Link, useNavigate } from 'react-router-dom'
import {
  CTable,
  CTableBody,
  CTableDataCell,
  CTableHead,
  CTableHeaderCell,
  CTableRow,
  CButton,
} from '@coreui/react'
import moment from 'moment'
import CIcon from '@coreui/icons-react'
import { cilPencil, cilSearch } from '@coreui/icons'

const Table = (props) => {
  let navigate = useNavigate()
  const { studentListing } = props
  const handleGoView = (e, id) => {
    e.preventDefault()
    navigate('/student/view/' + id)
  }

  const handleGoUpdate = (e, id) => {
    e.preventDefault()
    navigate('/student/update/' + id)
  }

  return (
    <>
      <CTable color="light">
        <CTableHead>
          <CTableRow>
            <CTableHeaderCell scope="col">ID</CTableHeaderCell>
            <CTableHeaderCell scope="col">First Name</CTableHeaderCell>
            <CTableHeaderCell scope="col">Last Name</CTableHeaderCell>
            <CTableHeaderCell scope="col">Email</CTableHeaderCell>
            <CTableHeaderCell scope="col">DOB</CTableHeaderCell>
            <CTableHeaderCell scope="col">Created At</CTableHeaderCell>
            <CTableHeaderCell scope="col"></CTableHeaderCell>
          </CTableRow>
        </CTableHead>
        <CTableBody>
          {studentListing.map((row) => (
            <CTableRow key={row.id}>
              <CTableHeaderCell scope="row">{row.id}</CTableHeaderCell>
              <CTableDataCell scope="row">{row.firstName}</CTableDataCell>
              <CTableDataCell scope="row">{row.lastName}</CTableDataCell>
              <CTableDataCell scope="row">{row.email}</CTableDataCell>
              <CTableDataCell scope="row">{row.dob}</CTableDataCell>
              <CTableDataCell scope="row">
                {row.createdAt && <>{moment(row.createdAt).format('Y-MM-DD hh:mm a')}</>}
              </CTableDataCell>
              <CTableDataCell scope="row">
                <CButton
                  color="dark"
                  variant="outline"
                  size="sm"
                  onClick={(e) => handleGoUpdate(e, row.id)}
                >
                  <CIcon icon={cilPencil} />
                </CButton>{' '}
                <CButton
                  color="info"
                  variant="outline"
                  size="sm"
                  onClick={(e) => handleGoView(e, row.id)}
                >
                  <CIcon icon={cilSearch} />
                </CButton>
              </CTableDataCell>
            </CTableRow>
          ))}
        </CTableBody>
      </CTable>
    </>
  )
}

Table.propTypes = {
  studentListing: PropTypes.array.isRequired,
}

export default Table
