import { WORKOUT_STATUSES_COLORS } from './constants.js'

window.addEventListener("DOMContentLoaded", () => {
    const chartContainer = document.getElementById('workouts-state-pie-container')
    const chart = echarts.init(chartContainer)

    const formattedData = Object.keys(workoutsByStatus).map(key => {
        return {
            value: workoutsByStatus[key].length,
            name: key, 
            color: WORKOUT_STATUSES_COLORS[key]
        }
    })

    console.log(formattedData)

    chart.setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            bottom: '0%',
            left: 'center'
        },
        series: [
            {
                type: "pie",
                data: formattedData,
                color: formattedData.map(data => data.color) 
            },
        ],
        graph: {
            color: formattedData.map(data => data.color)
        }
    });
});
