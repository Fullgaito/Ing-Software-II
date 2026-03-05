from locust import HttpUser, task #importamos las clases necesarias de locust
class SimpleCrudUser(HttpUser): #definimos una clase que hereda de HttpUser, que es la clase base para los usuarios de locust
    @task #decorador que indica que el método es una tarea que se ejecutará durante la prueba de carga
    def get_products(self): #definimos un método que se ejecutará como tarea, en este caso para obtener la lista de productos
        self.client.get("/ingredients") #utilizamos el cliente HTTP proporcionado por locust para hacer una solicitud GET a la ruta "/ingredients/10"

    @task
    def create_product(self):
        data = {
            "name": "Nuevo Ingrediente",
        }
        self.client.post("/ingredients", json=data)
    @task
    def update_product_put(self):
        data={
            "name": "Ingrediente Actualizado PUT",
        }
        self.client.put("/ingredients/1", json=data)
    @task
    def delete_product(self):
        self.client.delete("/ingredients/1")