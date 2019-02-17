export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('/login', {
            email: credentials.email,
            password: credentials.password
        }).then(response => {
            if(response.data.status == 'error') {
                handleError(rej);
            } else {
                res(response.data);
            }
        }).catch((err) => {
            handleError(rej);
        })
    });
}

export function getUser() {
    const user = localStorage.getItem("user");
    if(!user) {
        return null;
    }
    return JSON.parse(user);
}

function handleError(rej) {
    rej("Wrong email or password");
}


