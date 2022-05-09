import AsyncStorage from '@react-native-async-storage/async-storage';

const BASE_API = 'http://10.0.2.2:8000/api';

export default {
    checkToken: async (token) => {
        const req = await fetch(`${BASE_API}/auth/refresh`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ token })
        });
        const json = await req.json();
        return json;
    },
    signIn: async (email, password) => {
        const req = await fetch(`${BASE_API}/auth/login`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });
        const json = await req.json();
        return json;
    },
    signUp: async (name, email, password) => {
        const req = await fetch(`${BASE_API}/user`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, email, password })
        });
        const json = await req.json();
        return json;
    },

    logout: async () => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/auth/logout`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ token })
        });
        const json = await req.json();
        return json;
    },

    getDoctors: async () => {
        const token = await AsyncStorage.getItem('token');

        const req = await fetch(`${BASE_API}/doctors?token=${token}`);
        const json = await req.json();

        return json;
        console.log('getDoctors', json);
    },

    getDoctor: async (id) => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/doctor/${id}?token=${token}`);
        const json = await req.json();
        console.log(json);
        return json;
    },

    setFavorite: async (doctorId) => {
        const token = await AsyncStorage.getItem('token');

        const req = await fetch(`${BASE_API}/user/favorite`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ token, service: doctorId })
        });
        const json = await req.json();
        return json;
    },

    setAppointment: async (
        userId,
        service,
        selectedYear,
        selectedMonth,
        selectedDay,
        selectedHour) => {
        const token = await AsyncStorage.getItem('token');

        const req = await fetch(`${BASE_API}/doctor/${userId}/appointment`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token,
                service,
                year: selectedYear,
                month: selectedMonth,
                day: selectedDay,
                hour: selectedHour
            })
        });
        const json = await req.json();
        return json;
    },

    search: async (doctorName) => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/searchService?q=${doctorName}&token=${token}`);
        const json = await req.json();
        console.log(json);
        return json;
    },

    getFavorites: async () => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/user/favorites?token=${token}`);
        const json = await req.json();
        console.log(json);
        return json;
    },

    getAppointments: async () => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/user/appointments?token=${token}`);
        const json = await req.json();
        console.log(json);
        return json;
    },

    getUser: async () => {
        const token = await AsyncStorage.getItem('token');
        const req = await fetch(`${BASE_API}/user/getUser?token=${token}`);
        const json = await req.json();
        console.log(json);
        return json;
    },



    updateUser: async (body) => {
        const token = await AsyncStorage.getItem('token');
        body.token = token;

        const req = await fetch(`${BASE_API}/user`, {
            method: 'PUT',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(body)
        });
        const json = await req.json();
        return json;
    },



    deleteAppointment: async (id) => {
        const token = await AsyncStorage.getItem('token');

        const req = await fetch(`${BASE_API}/doctor/appointments/${id}?token=${token}`, {
            method: 'DELETE',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json'
            }
        });
        const json = await req.json();
        console.log(json);
        return json;
    }


};
