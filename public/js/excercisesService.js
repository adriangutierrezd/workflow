import { HTTP_STATUS } from './constants.js'

export const getExcercises = async () => {
    try {
        const response = await fetch(`/api/excercises`)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}

export const createExcercise = async ({ name }) => {
    try {
        const requestOptions = {
            method: 'POST',
            body: JSON.stringify({ name }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/excercise`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.CREATED) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}


export const deleteExcercise = async (excerciseId) => {
    try {
        const requestOptions = {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
        }

        const response = await fetch(`/api/excercise/${excerciseId}`, requestOptions)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}