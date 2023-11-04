export const getClusterByWorkout = async (workoutId) => {
    try {
        const response = await fetch(`/api/clusters/${workoutId}`)
        const data = await response.json()
        return data
    } catch (error) {
        throw new Error(error.message)
    }
}
