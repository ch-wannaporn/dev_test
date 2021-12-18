const bookingData = require('./data.json')

const checkAvailability = (roomId, startTime, endTime) => {
    const clientStartTime = new Date(startTime)
    const clientEndTime = new Date(endTime)
    
    const roomBookings = bookingData.filter(item => {
        const roomStartTime = new Date(item.startTime)
        const roomEndTime = new Date(item.endTime)

        return item.roomId === roomId && 
            ((clientStartTime > roomStartTime && clientStartTime < roomEndTime) || 
            (clientEndTime > roomStartTime && clientEndTime < roomEndTime))
    })

    return roomBookings.length === 0
}

const getBookingsForWeek = (roomId, weekNo) => {
    const todayBookings = []
    const thisWeekBookings = []
    const nextWeekBookings = []

    const today = new Date().setHours(0, 0, 0, 0)

    const allBookings = bookingData.filter(item => {
        return item.roomId === roomId
    })

    allBookings.forEach(item => {
        const startDate = new Date(item.startTime).setHours(0, 0, 0, 0)
        const endDate = new Date(item.endTime).setHours(0, 0, 0, 0)
        const startWeekNo = new Date(item.startTime)

        //return startDate === today || endDate === today
    
    })

    const roomBookings = {today: [], thisWeek: [], nextWeek: []}

    return "hi"
}

module.exports = {checkAvailability, getBookingsForWeek}