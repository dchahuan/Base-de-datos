CREATE OR REPLACE FUNCTION calcular_capacidad (npuerto varchar, fecha_inicio date, fecha_fin date)
RETURNS TABLE (iid integer, dias date, capacidad float) AS $$
DECLARE
    r1 record;
    r2 record;
    r3 record;
    r4 record;
    r5 record;
    usos float;
    capacidad float;
    instalacion int;
BEGIN
    CREATE TABLE capacidad(iid integer, dias date, capacidad float);
    CREATE TABLE fechas AS (select dias.dias::date from generate_series(fecha_inicio, fecha_fin, '1 day'::interval) as dias);
    FOR r1 in select * from fechas LOOP
        FOR r2 in SELECT Instalaciones.id_instalacion, capacidad_instalacion FROM instalaciones, Esta_en WHERE Instalaciones.tipo_instalacion = 'astillero' and Instalaciones.id_instalacion = Esta_en.id_instalacion AND Esta_en.nombre_puerto = npuerto LOOP
	    instalacion := r2.id_instalacion;
	    usos := 0;
	    FOR r3 in select Instalaciones.id_instalacion, tipo_instalacion, capacidad_instalacion, fecha_atraque::date, fecha_salida::date from instalaciones, esta_en, permisos_astilleros where instalaciones.id_instalacion = esta_en.id_instalacion and esta_en.nombre_puerto = npuerto and esta_en.id_instalacion = instalacion and instalaciones.id_instalacion = permisos_astilleros.id_instalacion LOOP
            	IF (r1.dias BETWEEN r3.fecha_atraque AND r3.fecha_salida) THEN
		    usos := usos + 1;
		END IF;
	    END LOOP;
	    IF (usos < r2.capacidad_instalacion) THEN
		capacidad := (usos/r2.capacidad_instalacion::float)*100;
	        INSERT INTO capacidad VALUES(instalacion, r1.dias, capacidad);
		usos := 0;
	    END IF;
	END LOOP;
	FOR r4 in SELECT Instalaciones.id_instalacion, capacidad_instalacion FROM instalaciones, Esta_en WHERE Instalaciones.tipo_instalacion = 'muelle' and Instalaciones.id_instalacion = Esta_en.id_instalacion AND Esta_en.nombre_puerto = npuerto LOOP
	    instalacion := r4.id_instalacion;
	    usos := 0;
	    FOR r5 in select Instalaciones.id_instalacion, tipo_instalacion, capacidad_instalacion, fecha_atraque::date from instalaciones, esta_en, permisos_muelles where instalaciones.id_instalacion = esta_en.id_instalacion and esta_en.nombre_puerto = npuerto and esta_en.id_instalacion = instalacion and instalaciones.id_instalacion = permisos_muelles.id_instalacion LOOP
		IF (r5.fecha_atraque = r1.dias) THEN
		    usos := usos + 1;
		END IF;
	    END LOOP;
	    IF (usos < r4.capacidad_instalacion) THEN
		capacidad := (usos/r4.capacidad_instalacion::float)*100;
	        INSERT INTO capacidad VALUES(instalacion, r1.dias, capacidad);
		usos := 0;
	    END IF;
	END LOOP;
    END LOOP;
    RETURN QUERY SELECT * FROM capacidad;
    DROP TABLE capacidad;
    DROP TABLE fechas;
    RETURN;		
END;
$$ language plpgsql;