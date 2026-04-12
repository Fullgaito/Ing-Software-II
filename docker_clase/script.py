import requests

def main():
    print("ejecutando script dentro de un contenedor docker")
    response=requests.get("http://api.github.com")
    if response.status_code==200:
        print("Respuesta recibida correctamente")
        print("headers:", response.headers)
    else:
        print("Error en la peticion:",response.status_code)
if __name__=="__main__":
    main()