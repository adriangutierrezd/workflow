export const getWorkouts = async () => {
    try {
        const response = await fetch('/api/workouts')
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}
