<template>
  <div>
    <div class="container">
    <h1>Liste des produits</h1>
    <br>
        <table class="table">
        <thead class="thead-dark">
            <tr class="table-info">
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Taille</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-primary" v-for="produit in produits" :key="produit.id">
            <td>{{ produit.nom }}</td>
            <td>{{ produit.description }}</td>
            <td>{{ produit.taille }}</td>
            </tr>
        </tbody>
        </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      produits: []
    };
  },
  mounted() {
    this.fetchProduits();
  },
  methods: {
    fetchProduits() {
      fetch('http://localhost:8001/api/liste-produit')
        .then(response => response.json())
        .then(data => {
          this.produits = data;
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>
