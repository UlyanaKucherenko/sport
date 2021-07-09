const api = {
  async getWeather() {
    const {lat, lon} = await fetch('http://ip-api.com/json').then(res => res.json()) // TODO using fetch because not working with axios
    const res = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=feb027b3faea87405a0cd6954a7dea30`).then(res => res.json())
    return res
  }
}

export {
  api
}
