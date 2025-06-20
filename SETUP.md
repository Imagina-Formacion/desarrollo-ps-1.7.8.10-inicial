# Setup del Entorno de Desarrollo

## 🚀 Instalación

1. Clona el repositorio:
   ```bash
   git clone <repository-url>
   cd <repository-name>
   ```

2. Inicia los contenedores:
   ```bash
   docker-compose up --build -d
   ```

3. Espera a que PrestaShop se instale automáticamente en `./prestashop/`

4. Accede a:
   - **PrestaShop**: http://localhost:8080
   - **phpMyAdmin**: http://localhost:8081
   - **Admin**: http://localhost:8080/admin (user: admin@prestashop.local, pass: admin123)

## 🐛 Debugging

1. Instala la extensión "PHP Debug" en VS Code
2. Presiona F5 para iniciar debugging
3. Coloca breakpoints en cualquier archivo PHP de `./prestashop/`

## 📁 Estructura

- `prestashop/` - Archivos de PrestaShop (solo local, no en git)
- `custom-modules/` - Tus módulos personalizados
- `custom-themes/` - Tus temas personalizados
- `conf/` - Configuraciones de Apache/Xdebug
