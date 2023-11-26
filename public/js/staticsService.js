export const staticsPerExcercise = async ({ userId, startDate, endDate }) => {
    try {

        let url = `/api/statics-per-excercise/${userId}`
        if (startDate !== undefined) url = `${url}/${startDate}`
        if (endDate !== undefined) url = `${url}/${endDate}`

        const response = await fetch(url)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}

export const getExcerciseData = async({ userId, excerciseId, startDate, endDate }) => {
    try {

        let url = `/api/statics-excercise-data/${excerciseId}/${userId}`
        if (startDate !== undefined) url = `${url}/${startDate}`
        if (endDate !== undefined) url = `${url}/${endDate}`

        const response = await fetch(url)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}

export const getExcerciseUsage = async({ userId, excerciseId, startDate, endDate }) => {
    try {

        let url = `/api/statics-excercise-usage/${excerciseId}/${userId}`
        if (startDate !== undefined) url = `${url}/${startDate}`
        if (endDate !== undefined) url = `${url}/${endDate}`

        const response = await fetch(url)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}