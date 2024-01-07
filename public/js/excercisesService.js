import { HTTP_STATUS } from './constants.js'

export const getExcercises = async (trainerId) => {
    try {
        const response = await fetch(`/api/excercises`)
        const data = await response.json()
        if (response.status !== HTTP_STATUS.OK) throw new Error(data.message)
        return { ...data, status: response.status }
    } catch (error) {
        throw new Error(error.message)
    }
}
