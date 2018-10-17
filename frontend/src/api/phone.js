import request from '@/utils/request'
export function phoneIndex(params) {
  return request({
    url: `/phone`,
    method: 'get',
    params
  })
}

export function phoneStore(data) {
  return request({
    // params,
    data,
    url: `/phone`,
    method: 'post'
  })
}
export function phoneShow(id) {
  return request({
    url: `/phone/${id}`,
    method: 'get'
    // params
  })
}

export function phoneUpdate(id, data) {
  return request({
    // params,
    data,
    url: `/phone/${id}`,
    method: 'put'
  })
}
export function phoneDestroy(id) {
  return request({
    // params,
    url: `/phone/${id}`,
    method: 'delete'
  })
}

export function getProgramFilesGitPhone() {
  return request({
    url: `/c:/program files/git/phone`,
    method: 'get'
    // params
  })
}

