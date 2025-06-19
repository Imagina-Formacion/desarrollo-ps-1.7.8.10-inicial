# PrestaShop 1.7.8.10 Docker Environment

Entorno Docker listo para instalar PrestaShop 1.7.8.10 desde cero con soporte para módulos personalizados.

## 🚀 Inicio Rápido

```bash
# 1. Clonar repositorio
git clone <repository-url>
cd <repository-name>

# 2. Iniciar contenedores
docker-compose up -d

# 3. Abrir PrestaShop
open http://localhost:8080
```

## 🔑 Credenciales de Instalación

Usa estas credenciales durante la instalación de PrestaShop:

### Base de Datos
- **Servidor**: `db`
- **Nombre**: `prestashop`
- **Usuario**: `prestashop`
- **Contraseña**: `prestashop`

### phpMyAdmin (opcional)
- **URL**: http://localhost:8081
- **Usuario**: `root`
- **Contraseña**: `root`

## 🛠️ Desarrollo Personalizado

### Módulos
La carpeta `custom-modules/` está preparada para desarrollo de módulos:
- Se montan automáticamente en `/modules/custom/` del contenedor
- Ver `custom-modules/README.md` para guía completa


### Características del desarrollo
- Los cambios se reflejan inmediatamente sin reiniciar
- Modo desarrollo activado para debugging

## 📁 Puertos

- **PrestaShop**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3306

## 🔧 Comandos Útiles

```bash
# Ver estado
docker-compose ps

# Ver logs
docker-compose logs -f

# Parar contenedores
docker-compose down

# Limpiar todo (datos incluidos)
docker-compose down -v

# Acceder al contenedor de PrestaShop
docker-compose exec prestashop bash
```

## 📁 Estructura

```
├── docker-compose.yml      # Configuración de servicios
├── custom-modules/         # Carpeta para módulos personalizados
│   └── README.md          # Guía de desarrollo de módulos
├── custom-themes/          # Carpeta para themes personalizados
│   └── README.md          # Guía de desarrollo de themes
└── README.md              # Este archivo
```

## 🎯 Características

- ✅ MySQL 5.7 + PrestaShop 1.7.8.10 + phpMyAdmin
- ✅ Entorno preparado para desarrollo de módulos
- ✅ Entorno preparado para desarrollo de themes
- ✅ Volúmenes persistentes para datos
- ✅ Modo desarrollo activado
