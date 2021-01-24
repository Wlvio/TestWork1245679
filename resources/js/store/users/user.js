const user = {
    state: {
      listUsersLoading: true,
      listUsers: [],
      createLoading: false,
    },
    actions: {
      getListUsers({ commit }) {
        commit('getListUserRequest');
        axios
          .get('/api/getUsers')
          .then(response => {
            commit('getListUsersSuccess', response.data);
          })
          .catch(() => {
            //
          });
      },
      addUser({ commit, dispatch }, { name, last_name }) {
        commit('addUserRequest');
        axios.post(`/api/createUser`, { name, last_name })
          .then(() => {
            dispatch('getListUsers');
            commit('addUserSuccess');
          })
          .catch(() => {
            //
          });
      },
      updateUser({ dispatch }, { id, name, last_name }) {
        axios.put(`/api/updateUser`, { id, name, last_name })
          .then(() => {
            dispatch('getListUsers');
          })
          .catch(() => {
            //
          });
      },
      removeUser({ dispatch }, id) {
        axios.delete(`/api/removeUser`, {
          data: {
            id,
          },
        })
        .then(() => {
          dispatch('getListUsers');
        })
        .catch(() => {
          //
        });
      },
    },
    getters: {
      listUsersLoading(state) {
        return state.listUsersLoading;
      },
      listUsers(state) {
        return state.listUsers;
      },
      createLoading(state) {
        return state.createLoading;
      }
    },
    mutations: {
      getListUserRequest(state) {
        state.listUsersLoading = true;
      },
      getListUsersSuccess(state, data) {
        state.listUsers = data;
        state.listUsersLoading = false;
      },
      addUserRequest(state) {
        state.createLoading = true;
      },
      addUserSuccess(state) {
        state.createLoading = false;
      },
    },
}

export default user;
