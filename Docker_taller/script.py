import psycopg2

conn_params={
    "dbname":"mydatabase",
    "user":"myuser",
    "password":"mypassword",
    "host":"localhost",#Cambia esto si esta en otro contenedor
    "port":5432
}

def create_table():
    with psycopg2.connect(**conn_params) as conn:
        with conn.cursor() as cur:
            cur.execute("""
                CREATE TABLE IF NOT EXISTS users(
                    id SERIAL PRIMARY KEY,
                    name VARCHAR(100),
                    email VARCHAR(100)    
                );
            """)
            conn.commit()
            print("Tabla 'users'creada")

def insert_data(name,email):
    with psycopg2.connect(**conn_params) as conn:
        with conn.cursor() as cur:
            cur.execute("INSERT INTO users(name.email) VALUES (%s,%s)",(name,email))
            conn.commit()
            print("Datos insertados correctamente")

def query_data():
    with psycopg2.connect(**conn_params) as conn:
        with conn.cursor() as cur:
            cur.execute("SELECT * FROM users")
            rows=cur.fetchall()
            for row in rows:
                print(f"ID:{row[0]}, Name: {row[1]}, Email:{row[2]}")

#ejecucion ejemplo

if __name__=="__main__":
    create_table()
    insert_data("Juan Perez","juan@gmail.com")
    query_data()
