# Setup del Entorno de Desarrollo PrestaShop 1.7.8.10

## 🚀 Instalación Rápida

1. **Clona el repositorio**:
   ```bash
   git clone <repository-url>
   cd <repository-name>
   ```

2. **Inicia los contenedores**:
   ```bash
   docker-compose up --build -d
   ```

3. **Espera unos minutos** y accede a:
   - **PrestaShop**: http://localhost:8080
   - **phpMyAdmin**: http://localhost:8081
   - **Admin**: http://localhost:8080/admin (user: admin@prestashop.local, pass: admin123)

## � Desarrollo de Módulos y Temas

### Ubicación de archivos personalizados:
- **Módulos**: `custom-modules/` → Se montan en `/modules/custom/`
- **Temas**: `custom-themes/` → Se montan en `/themes/custom/`

### Debugging básico:
1. Instala la extensión "PHP Debug" en VS Code
2. Presiona F5 para iniciar debugging
3. Coloca breakpoints en tus archivos de `custom-modules/` y `custom-themes/`

## 🐛 Debugging Avanzado (Opcional)

Para debuggear archivos del core de PrestaShop:

1. **Copia archivos del contenedor**:
   ```bash
   # Crear carpeta local
   mkdir prestashop-debug

   # Copiar archivos específicos que necesites debuggear
   docker-compose exec prestashop cp -r /var/www/html/classes ./prestashop-debug/
   docker-compose exec prestashop cp -r /var/www/html/controllers ./prestashop-debug/
   ```

2. **Actualiza temporalmente** tu `.vscode/launch.json`:
   ```json
   "pathMappings": {
       "/var/www/html/classes": "${workspaceFolder}/prestashop-debug/classes",
       "/var/www/html/controllers": "${workspaceFolder}/prestashop-debug/controllers",
       "/var/www/html/modules/custom": "${workspaceFolder}/custom-modules",
       "/var/www/html/themes/custom": "${workspaceFolder}/custom-themes"
   }
   ```

## 📁 Estructura del Proyecto

```
proyecto/
├── docker-compose.yml        # Configuración de servicios
├── Dockerfile.prestashop     # Imagen personalizada con Xdebug
├── conf/                     # Configuraciones
│   ├── apache/
│   └── php/
├── custom-modules/           # Tus módulos personalizados
├── custom-themes/            # Tus temas personalizados
├── logs/                     # Logs del sistema
└── .vscode/                  # Configuración de VS Code
    └── launch.json
```

## 🛠️ Comandos Útiles

```bash
# Ver logs de PrestaShop
docker-compose logs -f prestashop

# Acceder al contenedor
docker-compose exec prestashop bash

# Reiniciar servicios
docker-compose restart

# Limpiar todo (cuidado: borra datos)
docker-compose down -v
```

## ⚠️ Notas Importantes

- Los archivos del core de PrestaShop están en el volumen Docker, no en tu carpeta local
- Solo los archivos en `custom-modules/` y `custom-themes/` se sincronizan automáticamente
- Para debugging avanzado, copia manualmente los archivos que necesites
