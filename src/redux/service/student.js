import http from 'src/httpCommon'

class StudentService {
  get(id) {
    return http.get(`/student/${id}`)
  }

  create(data) {
    return http.post('/student/add', data)
  }

  update(id, data) {
    return http.put(`/student/update/${id}`, data)
  }
}

export default new StudentService()
