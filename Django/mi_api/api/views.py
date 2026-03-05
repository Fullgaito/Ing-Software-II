from django.shortcuts import render
from rest_framework import viewsets
from .models import Producto
from .serializars import ProductoSerializer
from .permissions import ValidarTokenPersonalizado
# Create your views here.

class ProductoViewSet(viewsets.ModelViewSet):
    queryset = Producto.objects.all() #Obtiene todos los objetos de la tabla Producto
    serializer_class = ProductoSerializer
    permission_classes = [ValidarTokenPersonalizado] #Agrega la clase de permisos personalizada
