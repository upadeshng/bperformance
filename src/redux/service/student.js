import http from 'src/httpCommon'

class StudentService {
  getAll() {
    return http.get('/student')
  }

  get(id) {
    return http.get(`/student/${id}`)
  }

  create(data) {
    return http.post('/student/add', data)
  }

  update(id, data) {
    return http.put(`/student/update/${id}`, data)
  }

  delete(id) {
    return http.delete(`/student/delete/${id}`)
  }
}

export default new StudentService()
