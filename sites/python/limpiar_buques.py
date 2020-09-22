import os

def rm_whitespace(tupla):
    
    nueva_tuple = []

    for i in tupla:
        if i.strip() != "":
            nueva_tuple.append(i.strip())

    return tuple(nueva_tuple)

def cargar_archivos(path):
    with open(os.path.join("Pares",path), "r") as archivo:
        archivo = archivo.read().split("\n")

    return [linea.split(",") for linea in archivo]

def separar_buques(lista_buques):

    dic_tipos = {"carga":[], "petrolero": [], "pesquero":[]}

    for i in lista_buques[1:len(lista_buques)-1]:
        dic_tipos[i[4]].append(i)

    return dic_tipos

def mismo_len(lista):

    return len(list(filter(lambda x: len(x) == len(lista[0]), lista))) == len(lista)

def sacar_naviera(lista):

    navieras = set()

    for nav in lista[1:]:
        navieras.add(nav[-3:len(nav)])
    
    navieras.remove(())
    return list(navieras)

def sacar_especializacion(lista):

    return [tuple([buque[0]] + list(buque[5:-4])) for buque in lista]

def encontrar_id(lista_navieras, naviera):
    for i in lista_navieras:
        if naviera == i[1:]:
            return i[0]
    return None
    
def esquema_buques(lista,navieras):
    lista_buques = []
    
    for i in lista[1:len(lista)-1]:
        buque = []
        buque.extend(i[0:5])
        naviera_buque = tuple(i[-3:len(i)])
        id_nav = encontrar_id(navieras, naviera_buque)
        buque += i[-4]
        buque += [id_nav]
        
        lista_buques.append(tuple(buque))
    
    lista_buques
    return lista_buques
        
def separar_tipos(data):
    dic_itenerarios = {"proximos":[], "historial":[]}
    for i in data[:len(data)-1]:
        
        if i[1] == "":
            dic_itenerarios["proximos"].append(tuple(i))
        else:
            dic_itenerarios["historial"].append(tuple(i))
            
    return dic_itenerarios       


datos = cargar_archivos("buques.csv")

data_itinerario = cargar_archivos("itinerarios.csv")

data_personal = cargar_archivos("personal_buque.csv")

datos_sin_espacio = [rm_whitespace(linea) for linea in datos]

dic_buques = separar_buques(datos_sin_espacio)

lista_navieras  = sacar_naviera(datos_sin_espacio)

data_separada = separar_tipos(data_itinerario)


#Personal id_personal,nombre,nacionalidad,pasaporte,edad,genero,id_buque
personal = [tuple(i) for i in data_personal[:len(data_personal)-1]]

# Proximos
proximos_atraques = [(i[0], i[2],i[3]) for i in data_separada["proximos"]]

# Historial
historial = data_separada["historial"]

# Navieras con id, nombre, pais, Especilizacion
navieras_format = [(i,lista_navieras[i][0],lista_navieras[i][1],lista_navieras[i][2]) for i in range(len(lista_navieras))]



print(navieras_format)
#Buques totales id_buque,nombre,patente,pais,tipo,id_cap, 
buques_esquemas = esquema_buques(datos_sin_espacio,navieras_format)


buques_esquemas = [i[:-1] for i in buques_esquemas]

# Datos pesqueros id, tipo_pesca
pesquero_atr = sacar_especializacion(dic_buques["pesquero"])

# Datos petroleros id, max_litros
petrolero_atr = sacar_especializacion(dic_buques["petrolero"])


# Datos carga id, max_conteiner, max_ton
carga_atr = sacar_especializacion(dic_buques["carga"])

# Relacion Capitan Buque (id, id)
buques_cap = [(i[0],i[-4]) for i in datos_sin_espacio[1:-1]]

# Relacion Personal Buque(id id)
buques_personal = [(i[0],i[-1]) for i in data_personal[1:-1] if i not in buques_cap]

# Relacion Naviera Buque (id,id)
buques_navieras = esquema_buques(datos_sin_espacio,navieras_format)


buques_navieras = [(i[-1],i[0]) for i in buques_navieras]
