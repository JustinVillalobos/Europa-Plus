ALTER TABLE `alumnos` CHANGE `alu_dni` `alu_dni` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT '';

ALTER TABLE `escuelas` CHANGE `esc_fax` `esc_fax` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT '';

-- Falta columna nueva en cursos y alojamientos

--Nueva tabla tipos