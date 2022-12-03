async function http_request(url) {
  return await fetch(url).then(response => { return response.text(); });
}
