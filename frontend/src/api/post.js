import request from '@/utils/request'
export function postIndex() {
  return request({
    url: `/post`,
    method: 'get'
    // params
  })
}

export function postStore(data) {
  return request({
    // params,
    data,
    url: `/post`,
    method: 'post'
  })
}
export function postShow(id) {
  return request({
    url: `/post/${id}`,
    method: 'get'
    // params
  })
}

export function postUpdate(id, data) {
  return request({
    // params,
    data,
    url: `/post/${id}`,
    method: 'put'
  })
}
export function postDestroy(id) {
  return request({
    // params,
    url: `/post/${id}`,
    method: 'delete'
  })
}
