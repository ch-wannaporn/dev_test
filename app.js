const bookingData = require('./data.json')

const checkAvailability = (roomId, startTime, endTime) => {
    const room = bookingData.find(item => {
        return item.roomId === roomId 
    })
    
    const roomStartTime = new Date(room.startTime)
    const roomEndTime = new Date(room.endTime)

    const clientStartTime = new Date(startTime)
    const clientEndTime = new Date(endTime)

    return roomEndTime < clientStartTime || roomStartTime > clientEndTime
}

const getBookingsForWeek = (roomId, weekNo) => {
    return "hello"
}

module.exports = {checkAvailability, getBookingsForWeek}