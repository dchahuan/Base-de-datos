import pandas as pd
from sqlalchemy import create_engine

engine = create_engine('postgresql://grupo16:gianluchahuan@codd.ing.puc.cl:5432/grupo16e3')
con = engine.connect()
df = pd.read_csv("coordenadas_puertos.csv")
df.to_sql("ubicacion",engine,index=False, if_exists="append")
con.close()
