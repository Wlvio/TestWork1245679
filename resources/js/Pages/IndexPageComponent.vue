<template>
  <div class="index-page__place-table">
    <h1 class="index-page__title">CRUD table</h1>
    <UserComponent />
  </div>
</template>

<script>
  import UserComponent from '../components/UserComponent';
  export default {
    name: 'IndexPageComponent',
    components: {
      UserComponent,
    },
  }
</script>
