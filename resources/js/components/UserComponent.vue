<template>
  <div>
    <template v-if="!listUsersLoading">
      <div class="m-1 text-right">
        <v-dialog
          v-model="dialog"
          persistent
          max-width="500"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn elevation="2" v-bind="attrs" v-on="on">
              <v-icon medium>add</v-icon> ADD
            </v-btn>
          </template>
          <v-card>
              <v-card-title class="headline">
                Create line
              </v-card-title>
              
              <v-form
                ref="addForm"
                v-model="valid"
                lazy-validation
              >
                <v-card-text>
                  <v-text-field
                    v-model="createForm.name"
                    label="Name"
                    :rules="nameRules"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="createForm.last_name"
                    label="Last name"
                    :rules="lastNameRules"
                    required
                  ></v-text-field>
                </v-card-text>
                <v-card-actions>
                  <v-btn
                    :disabled="createLoading"
                    color="primary"
                    text
                    @click="create"
                  >
                    <v-progress-circular v-if="createLoading" :size="20" indeterminate class="primary--text"/>
                    <template v-if="!createLoading">Create</template>
                  </v-btn>
                  <v-btn
                    :disabled="createLoading"
                    color="primary"
                    text
                    @click="close"
                  >
                    <template>Close</template>
                  </v-btn>
                  
                </v-card-actions>
              </v-form>
            </v-card>
          </v-dialog>
      </div>
      <v-simple-table :key="paintKey">
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left index-page__tab__text">
                Name
              </th>
              <th class="text-left index-page__tab__text">
                Last name
              </th>
              <th class="text-center">
                Edit
              </th>
              <th class="text-center">
                Remove
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in peoples"
              :key="index"
            >
              <td>
                <template v-if="!item.edit">
                  {{ item.name }}
                </template>
                <template v-if="item.edit">
                  <v-text-field v-model="item.name"></v-text-field>
                </template>
              </td>
              <td>
                <template v-if="!item.edit">
                  {{ item.last_name }}
                </template>
                <template v-if="item.edit">
                  <v-text-field v-model="item.last_name"></v-text-field>
                </template>
              </td>
              <td class="text-center">
                <v-btn v-if="!item.edit && !item.saveLoader && !item.removeLoader" @click="edit(index)" class="mx-2" fab small color="#eeeeeee" icon>
                  <v-icon medium>edit</v-icon>
                </v-btn>
                <template v-if="item.edit && !item.removeLoader">
                  <v-btn v-on:click="save(index)" class="mx-2" fab small color="#eeeeeee" icon>
                    <v-icon medium>save</v-icon>
                  </v-btn>
                  <v-btn v-on:click="discard" class="mx-2" fab small color="#eeeeeee" icon>
                    <v-icon medium>cancel</v-icon>
                  </v-btn>
                </template>
                <template v-if="item.saveLoader && !item.removeLoader">
                  <v-progress-circular :size="20" indeterminate class="primary--text"/>
                </template>
              </td>
              <td class="text-center">
                <v-btn v-if="!item.saveLoader && !item.removeLoader" @click="remove(index)" class="mx-2" fab small color="#eeeeeee" icon>
                  <v-icon medium>
                    clear
                  </v-icon>
                </v-btn>
                <template v-if="item.removeLoader">
                  <v-progress-circular :size="20" indeterminate class="primary--text"/>
                </template>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>
    </template>
    <div class="text-center m-5" v-if="listUsersLoading">
      <v-progress-circular :size="70" indeterminate class="primary--text"/>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';
  export default {
    name: 'UserCompontnt',
    mounted() {
      this.getUsers();
    },
    data () {
      return {
        paintKey: 0,
        peoples: [],
        dialog: false,
        valid: true,
        createForm: {
          name: '',
          last_name: '',
        },
        nameRules: [
          v => !!v || 'Name is required',
        ],
        lastNameRules: [
          v => !!v || 'Last name is required',
        ],
      }
    },
    computed: {
      ...mapGetters({
        listUsersLoading: 'listUsersLoading',
        listUsers: 'listUsers',
        createLoading: 'createLoading',
      }),
    },
    methods: {
      ...mapActions({
        getListUsers: 'getListUsers',
        addUser: 'addUser',
        updateUser: 'updateUser',
        removeUser: 'removeUser',
      }),
      getUsers() {
        this.getListUsers();
      },
      paintKeyAdd() {
        this.paintKey += 1;
      },
      edit(index) {
        this.peoples[index].edit = typeof this.peoples[index].edit === 'undefined'
          ? true
          : !this.peoples[index].edit;
        this.paintKeyAdd();
      },
      save(index) {
        this.peoples[index].edit = false;
        this.peoples[index].saveLoader = true;
        this.paintKeyAdd();
        this.updateUser(this.peoples[index]);
      },
      remove(index) {
        this.peoples[index].removeLoader = true;
        this.paintKeyAdd();
        this.removeUser(this.peoples[index].id);
      },
      create() {
        if (this.$refs.addForm.validate()) {
          this.addUser(this.createForm);
        }
      },
      close() {
        this.dialog = false;
      },
      discard() {
        this.peoples = this.$lodash.cloneDeep(this.listUsers);
      },
    },
    watch: {
      listUsers(value) {
        this.peoples = this.$lodash.cloneDeep(value);
      },
      createLoading(value) {
        if (value === false) {
          this.dialog = false;
        }
      },
    },
  }
</script>
