window.addEventListener("DOMContentLoaded", () => {
    const chartContainer = document.getElementById('workouts-state-pie-container')
    const chart = echarts.init(chartContainer);

    chart.setOption({
        series: [
            {
                type: "pie",
                data: [
                    {
                        value: 335,
                        name: "Direct Visit",
                    },
                    {
                        value: 234,
                        name: "Union Ad",
                    },
                    {
                        value: 1548,
                        name: "Search Engine",
                    },
                ],
            },
        ],
    });
});
