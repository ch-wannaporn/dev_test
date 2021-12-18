const bookingData = require('./data.json')

Date.prototype.getWeekNumber = function(){
    var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
    var dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
    return Math.ceil((((d - yearStart) / 86400000) + 1)/7)
};

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
    const thisWeek = +weekNo
    const nextWeek = thisWeek + 1

    const allBookings = bookingData.filter(item => {
        return item.roomId === roomId
    })

    allBookings.forEach(item => {
        const startDate = new Date(item.startTime).setHours(0, 0, 0, 0)
        const endDate = new Date(item.endTime).setHours(0, 0, 0, 0)
        const startWeekNo = new Date(item.startTime).getWeekNumber()
        const endWeekNo = new Date(item.endTime).getWeekNumber()

        if(startDate === today || endDate === today)
            todayBookings.push(item)
        if(startWeekNo === thisWeek || endWeekNo === thisWeek)
            thisWeekBookings.push(item)
        if(startWeekNo === nextWeek || endWeekNo === nextWeek)
            nextWeekBookings.push(item)
    })

    return {today: todayBookings, thisWeek: thisWeekBookings, nextWeek: nextWeekBookings}
}

module.exports = {checkAvailability, getBookingsForWeek}