export const getChartStyles = () => {

    const dark = document.documentElement.classList.contains('dark')
    if(dark){
        return {
            splitLineColor: '#64748b',
            yAxisSplitLine: {
                lineStyle: {
                    color: '#64748b'
                }
            }
        }
    }

    return {}

}