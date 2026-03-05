from locust import HttpUser, task #importamos las clases necesarias de locust
class SimpleCrudUser(HttpUser): #definimos una clase que hereda de HttpUser, que es la clase base para los usuarios de locust
    @task #decorador que indica que el método es una tarea que se ejecutará durante la prueba de carga
    def get_products(self): #definimos un método que se ejecutará como tarea, en este caso para obtener la lista de productos
        self.client.get("/products/10") #utilizamos el cliente HTTP proporcionado por locust para hacer una solicitud GET a la ruta "/products/10"

    @task
    def create_product(self):
        data = {
            "title": "Nuevo Producto",
            "price": 60.0,
            "description": "Producto creado en test",
            "image":"https://i.pravatar.cc",
            "category": "electronics",
        }
        self.client.post("/products", json=data)
    @task
    def update_product_put(self):
        data={
            "title": "Producto Actualizado PUT",
            "price": 70.0,
            "description": "Producto actualizado en test con PUT",
            "image":"https://i.pravatar.cc",
            "category": "electronics",
        }
        self.client.put("/products/10", json=data)
    @task
    def delete_product(self):
        self.client.delete("/products/10")