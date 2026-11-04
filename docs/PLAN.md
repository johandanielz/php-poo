# 📚 Plan de estudio: PHP, Laravel y vacante de desarrollador backend

> Documento de referencia del plan. Se actualiza a medida que avanzan las fases.
> Para retomar el plan en una conversación nueva, ver la sección [Cómo retomar](#-cómo-retomar-en-una-conversación-nueva).

---

## 🎯 Objetivo

Adquirir y **demostrar con proyectos propios** las habilidades que pide una vacante de desarrollador PHP/Laravel:

| Requisito de la vacante | Dónde se practica | Evidencia para el reclutador |
|---|---|---|
| PHP + Laravel | Fases 1–3 | Repositorios del proyecto |
| APIs REST (crear y consumir) | Fases 2–3 | Colección de Postman + documentación |
| Bases de datos SQL y NoSQL | Fases 3 y 5 | Migraciones (PostgreSQL) + servicio con MongoDB/Redis |
| Git y control de versiones | Todo el plan | Historial de commits, ramas y Pull Requests |
| Microservicios / arquitectura cliente-servidor | Fases 2 y 5 | Diagrama de arquitectura + Docker Compose |
| CI/CD y pruebas de software | Fases 1 (semanas 3–4) y 4 | Badge verde de GitHub Actions + cobertura |
| Buenas prácticas (Clean Code) | Todo el plan, sobre todo Fase 1 | Código organizado, refactors visibles en los commits |

Temas adicionales incluidos a pedido: **Laravel 12**, **Git avanzado** (ramas, `cherry-pick`, `revert`), **Docker básico**, **Jobs y colas**, **migraciones**, **Eloquent** y **patrones de diseño**.

---

## 🧭 Decisiones tomadas

| Tema | Decisión | Motivo |
|---|---|---|
| Versión de Laravel | **Laravel 12** | Es la que pide la vacante. Los conocimientos sirven casi completos para Laravel 13 |
| Versión de PHP | **PHP 8.3** | Compatible con Laravel 12 y 13 |
| Base de datos SQL | **PostgreSQL** (en lugar de MySQL) | Muy usada en empresas y soportada de forma nativa por Laravel |
| Entorno | **Docker + Dev Containers sobre WSL2** | Nada de PHP, Composer ni bases de datos instalado directamente en Windows |
| Ubicación del código | Dentro de WSL: `~/proyectos/plan-laravel/` | Docker + Laravel es mucho más lento si el código está en `C:\` |
| Repositorios | **Uno por proyecto** | Un reclutador entiende cada proyecto de un vistazo |
| Proyecto de POO (Fase 1) | **Biblioteca** | Muchos objetos que interactúan; dominio distinto al de los demás proyectos |
| Estilo de aprendizaje | Guiado y paso a paso | Primero el problema, luego la herramienta; Johan escribe el código y Claude revisa |

---

## 🗂️ Repositorios

```
~/proyectos/plan-laravel/        ← carpeta normal, NO es un repositorio
 ├── php-poo/                    ← Fase 1 (este repositorio)
 ├── php-mini-mvc/               ← Fase 2
 ├── <proyecto-laravel>/         ← Fases 3 y 4 (nombre por definir)
 └── <servicio-notificaciones>/  ← Fase 5 (o monorepo con el anterior, por decidir)
```

| Repositorio | Contenido | Estado |
|---|---|---|
| [`johandanielz/php-poo`](https://github.com/johandanielz/php-poo) | POO, SOLID y patrones con un sistema de biblioteca | 🟡 En curso |
| `php-mini-mvc` | Mini framework propio con PDO + Docker Compose | ⚪ Pendiente |
| Proyecto principal Laravel | API REST completa | ⚪ Pendiente |
| Microservicio | Notificaciones/logs con Redis y MongoDB | ⚪ Pendiente |

Cada repositorio tiene su **propio `.devcontainer`** (entorno reproducible).

---

## 🗺️ Vista general de las fases

| Fase | Tema | Duración aprox.* | Estado |
|---|---|---|---|
| 0 | Entorno: WSL2, Docker, VS Code, Git, SSH | 2–3 días | ✅ Completada |
| 1 | POO + patrones de diseño en PHP | 4 semanas | 🟡 En curso (1.0 lista) |
| 2 | PHP web sin framework + Docker | 2 semanas | ⚪ Pendiente |
| 3 | Laravel 12 + API REST | 4–5 semanas | ⚪ Pendiente |
| 4 | Jobs, pruebas y CI/CD | 2 semanas | ⚪ Pendiente |
| 5 | NoSQL + microservicios | 2–3 semanas | ⚪ Pendiente |
| 6 | Portafolio | 1 semana | ⚪ Pendiente |
| 🔁 | Git avanzado (transversal) | Todo el plan | 🟡 En curso |

\*Calculado con unas 10–12 horas por semana. Total estimado: 16–18 semanas. Lo importante es terminar cada fase, no cumplir la fecha.

---

## Fase 0: Entorno ✅

```
┌──────────────────────── Windows 11 ────────────────────────┐
│  VS Code   +   Docker Desktop                               │
│                     │                                       │
│  ┌──────────────── WSL2 (Ubuntu) ───────────────────────┐  │
│  │  📁 ~/proyectos/plan-laravel  ← el código vive aquí  │  │
│  │  Git + llave SSH + ssh-agent (keychain)               │  │
│  │                                                       │  │
│  │   ┌──── Contenedor "app" ────┐  ┌── Contenedor "db" ──┐│  │
│  │   │ PHP 8.3, Composer, Git,  │──│  PostgreSQL         ││  │
│  │   │ openssh-client           │  │  (desde la Fase 2)  ││  │
│  │   └──────────────────────────┘  └─────────────────────┘│  │
│  └───────────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────────┘
```

Configuración realizada:

- [x] WSL2 + Ubuntu instalados desde cero y actualizados
- [x] `.wslconfig` con límite de recursos: `memory=6GB`, `processors=4`
- [x] Docker Desktop (AMD64) con motor WSL2 e integración con Ubuntu
- [x] Usuario de Linux agregado al grupo `docker` (sin `sudo` ni `chmod 666`)
- [x] VS Code con las extensiones **WSL** y **Dev Containers**
- [x] Git configurado (`user.name`, `user.email`, `init.defaultBranch main`)
- [x] Llave SSH `ed25519` vinculada a GitHub
- [x] `keychain` en `~/.bashrc` para mantener el agente SSH activo
- [x] Reenvío del agente SSH al contenedor: `push` directamente desde el Dev Container

---

## Fase 1: POO + patrones de diseño en PHP 🟡

**Repositorio:** `php-poo`. **Proyecto:** sistema de **biblioteca** que evoluciona durante las 4 semanas.

```
Semana 1          Semana 2             Semana 3                Semana 4
Clases sueltas →  Jerarquías e     →   Orden con namespaces, → Patrones de diseño
con require_once  interfaces           Composer y SOLID        aplicados
      │                 │                    │                       │
   "funciona"      "es flexible"     "está bien organizado"   "es profesional"
```

Idea central: primero se siente el problema y luego se aprende la herramienta que lo resuelve (por ejemplo, `require_once` en la semana 1 → autoload de Composer en la semana 3).

### 1.0 Contenedor de desarrollo ✅

- [x] `.devcontainer/Dockerfile`: `php:8.3-cli` + `git`, `unzip`, `openssh-client` + Composer (`COPY --from=composer:2`) + usuario `dev` con UID 1000
- [x] `.devcontainer/devcontainer.json`: `remoteUser: dev` + extensión Intelephense
- [x] Sin `docker-compose.yml`: solo hay un servicio
- [x] Primer ciclo completo: rama → PR #1 → revisión → corrección → merge

### 1.1 Semana 1: clases, objetos y encapsulamiento ⚪

| Concepto | Equivalente en Java | Lo nuevo en PHP |
|---|---|---|
| Clases, objetos y `new` | Igual | `$this->propiedad` |
| Propiedades tipadas | Igual | `declare(strict_types=1)` para tipos estrictos |
| `public`, `private`, `protected` | Igual | — |
| Constructor | Mismo nombre que la clase | `__construct` + promoción de propiedades |
| `readonly` | Similar a `final` en atributos | Se asigna una sola vez |
| `static` | Igual | `self::` |

Primeras clases: `Libro` y `Socio`. Clean Code desde el día 1: nombres expresivos, métodos cortos, validaciones dentro de la clase.

### 1.2 Semana 2: herencia y polimorfismo ⚪

Herencia (`extends`), clases abstractas, interfaces (`implements`), polimorfismo, **traits** (no existen en Java) y **enums**.

Ideas para la biblioteca: materiales (`Libro`, `Revista`, `DVD`) con reglas de préstamo distintas; enum para el estado del préstamo (activo, devuelto, vencido) y para el tipo de socio; trait para comportamiento compartido (por ejemplo, "tiene autor").

### 1.3 Semana 3: organización, SOLID e inyección de dependencias ⚪

- Namespaces y estructura `src/`
- Composer con autoload **PSR-4**
- **SOLID**: un principio a la vez, con un refactor real para cada uno
- Inyección de dependencias (base del Service Container de Laravel)
- 🆕 **Primera GitHub Action**: verificar la sintaxis de los archivos PHP y validar `composer.json`

### 1.4 Semana 4: patrones de diseño ⚪

| Tipo | Patrón | Uso en la biblioteca | Dónde aparece en Laravel |
|---|---|---|---|
| Creacional | **Factory** | Crear el tipo de material correcto | Model Factories |
| Creacional | **Singleton** | Una sola instancia compartida | `app()->singleton()` |
| Estructural | **Adapter** | Unificar interfaces distintas | Drivers de caché, correo y almacenamiento |
| Estructural | **Decorator** | Agregar comportamiento sin modificar la clase | Middleware |
| Comportamiento | **Strategy** | Cálculo de multas según el tipo de socio | Drivers intercambiables |
| Comportamiento | **Observer** | Avisar a quien reservó cuando se devuelve el libro | Events, Listeners, Observers |
| Arquitectura | **Repository** | Buscar materiales por autor, título o disponibilidad | Se implementa en el proyecto |

- 🆕 **Pruebas unitarias** con PHPUnit, ejecutadas en GitHub Actions
- 💡 Lección pendiente: **nunca usar `float` para dinero** (aparece con el cálculo de multas)

### ✅ Al terminar la Fase 1

- Explicar los 4 pilares de la POO con ejemplos del propio código
- Explicar SOLID mostrando el *antes* y el *después* en el historial de commits
- Reconocer los patrones de diseño dentro de Laravel
- Trabajar con ramas, PRs, conflictos, `cherry-pick` y `revert`

---

## Fase 2: PHP web sin framework + Docker ⚪

**Repositorio:** `php-mini-mvc`.

**Semana 1, mini MVC:** router sencillo, controladores, conexión a PostgreSQL con PDO y una pequeña API que devuelve JSON. Así se entiende qué resuelven `Route::get(...)` y Eloquent antes de usarlos. Aquí se ve la **arquitectura cliente-servidor**: petición HTTP → servidor → respuesta.

**Semana 2, Docker a fondo:** escribir desde cero el `Dockerfile` y el `docker-compose.yml`.

```
docker-compose.yml
 ├── servicio "app"     → PHP 8.3 + pdo_pgsql + código
 ├── servicio "db"      → PostgreSQL
 └── servicio "adminer" → ver la base de datos en el navegador
```

| Concepto | Qué es |
|---|---|
| Imagen | La "plantilla" del entorno (como una clase) |
| Contenedor | Una imagen en ejecución (como un objeto) |
| `Dockerfile` | Receta para construir una imagen propia |
| `docker-compose.yml` | Orquesta varios contenedores que trabajan juntos |
| Volúmenes | Persisten los datos aunque se borre el contenedor |
| Redes | Permiten que `app` hable con `db` por nombre |

Se hace antes de Laravel a propósito: Laravel trae **Sail** (Docker ya configurado) y así se entiende qué pasa por debajo.

---

## Fase 3: Laravel 12 + API REST ⚪

**Proyecto principal (por elegir):**

| Opción | Descripción | Por qué es buena |
|---|---|---|
| A. Gestión de eventos y reservas | Usuarios crean eventos, otros reservan cupos, control de aforo | Reglas de negocio interesantes (cupos, cancelaciones) |
| B. Inventario para pequeños negocios | Productos, proveedores, entradas/salidas de stock, alertas de stock bajo | Muy realista; encaja con Strategy, Observer y Jobs |
| C. Plataforma de tareas por equipos | Proyectos, tareas, asignaciones, comentarios, roles | Permisos y relaciones complejas |

| Semana | Tema | Detalle |
|---|---|---|
| 1 | Fundamentos de Laravel 12 | Instalación, estructura, Artisan, ciclo de vida de una petición, Service Container, Service Providers, `.env` |
| 2 | Migraciones | Crear y modificar tablas, `rollback`, foreign keys, índices, Seeders y Factories |
| 3 | Eloquent ORM | Modelos, relaciones (1:1, 1:N, N:M, polimórficas), eager loading y **problema N+1**, scopes, accessors/mutators, casts |
| 4 | API REST | Rutas API, controladores de recursos, Form Requests, API Resources, Sanctum, códigos HTTP, paginación, manejo de errores |
| 5 | Consumo de APIs + patrones | Cliente HTTP de Laravel (consumir una API externa), Repository y Services aplicados |

> ⚠️ El problema N+1 es una de las preguntas técnicas más comunes en entrevistas de Laravel.

---

## Fase 4: Jobs, pruebas y CI/CD ⚪

**Jobs y colas:**

```
Usuario hace una acción
        │
        ▼
  API responde "201 Created" de inmediato ⚡
        │
        └──▶ dispatch(Job) ──▶ [Cola] ──▶ Worker procesa en segundo plano
                                          (envía el correo, genera el PDF...)
```

Crear Jobs, `dispatch`, drivers de cola (database y luego Redis), workers, reintentos, failed jobs, tareas programadas con el Scheduler.

**Pruebas:** unitarias y de integración/feature con PHPUnit o Pest, incluyendo `Queue::fake()` para probar Jobs.

**CI/CD con GitHub Actions:**
- **CI:** pruebas con base de datos + formato del código (Laravel Pint) en cada `push`
- **CD:** despliegue automático al hacer merge a `main`

---

## Fase 5: NoSQL + microservicios ⚪

```
  [Cliente / Postman]
          │  HTTP
          ▼
  ┌───────────────────────┐     HTTP / evento     ┌──────────────────────┐
  │  API principal         │ ────────────────────▶ │  Servicio de          │
  │  (Laravel + PostgreSQL)│                       │  notificaciones/logs  │
  └───────────────────────┘                       │  (MongoDB + Redis)    │
                                                  └──────────────────────┘
          └──────────── todo levantado con Docker Compose ────────────┘
```

- Cuándo conviene SQL y cuándo NoSQL
- Comunicación entre servicios
- Qué se gana y qué se pierde al separar un sistema en partes
- Decisión de arquitectura: repositorio propio o monorepo

---

## Fase 6: Portafolio ⚪

README completo en cada repositorio, documentación de la API, diagramas de arquitectura, badges de CI y despliegue.

---

## 🔁 Git avanzado (transversal)

| Momento | Concepto | Situación real | Estado |
|---|---|---|---|
| Fase 0 | `init`, `add`, `commit`, `push`, `remote` | Primer commit de `php-poo` | ✅ |
| Fase 1.0 | Ramas, Pull Request, revisión, merge, `fetch --prune` | PR #1 del devcontainer | ✅ |
| Fase 1 | Rama por tema (`feature/...`), merge a `main` | Cada semana de POO | ⚪ |
| Fase 1 | Conflicto de merge provocado a propósito | Semana 3 | ⚪ |
| Fase 1 | `cherry-pick` y `revert` | Semana 4 | ⚪ |
| Fase 2 | Flujo con ramas (`main`, `develop`, `feature/*`) | Mini MVC | ⚪ |
| Fase 3 | `cherry-pick` y `revert` vs `reset` | Corregir bugs entre ramas | ⚪ |
| Fase 4 | `rebase`, `stash`, etiquetas (`tag`) | Versiones `v1.0.0` | ⚪ |

> 💡 **`revert`** crea un commit nuevo que deshace otro: es seguro en ramas compartidas. **`reset`** reescribe el historial: solo en ramas locales.

## ⚙️ GitHub Actions (introducción por etapas)

| Momento | Qué hace la Action |
|---|---|
| Fase 1, semana 3 | Revisar sintaxis PHP y validar `composer.json` |
| Fase 1, semana 4 | Ejecutar pruebas unitarias con PHPUnit |
| Fase 4 | CI completo de Laravel + despliegue automático (CD) |

---

## 🤝 Flujo de trabajo

```
  Johan (Dev Container)             GitHub                      Claude
        │                             │                           │
        │── rama + commits + push ──▶ │                           │
        │── abre Pull Request ──────▶ │ ◀──── revisa el PR ────── │
        │                             │       (comentarios)       │
        │── corrige + push ─────────▶ │ ◀──── verifica ────────── │
        │── merge en GitHub ────────▶ │                           │
        │◀─ git pull ──────────────── │                           │
```

- **Nunca** se hace commit directo en `main`: todo pasa por rama + Pull Request.
- Nombres de rama con prefijo: `feature/...`, `fix/...`, `chore/...`, `docs/...`.
- Mensajes con **Conventional Commits**: `feat:`, `fix:`, `refactor:`, `style:`, `docs:`, `chore:`, `test:`.
- `git status` y `git diff` antes de cada commit.
- Después del merge: `git switch main`, `git pull`, `git branch -d <rama>`, `git fetch --prune`.
- Claude revisa con comentarios en el PR. GitHub no permite marcar "Approved" porque Claude actúa con la misma cuenta; el visto bueno queda como comentario.
- Claude solo crea ramas/PRs propios cuando Johan lo pide, y nunca escribe en `main`.

---

## 📝 Notas para Claude (cómo trabajar en este plan)

- Explicar en **español**, con tablas y diagramas.
- Enfoque **guiado, paso a paso**: explicar el concepto, Johan escribe el código, Claude revisa. No entregar soluciones completas de entrada.
- Mostrar primero el **problema** y después la herramienta que lo resuelve.
- **Construir sobre el código existente**, no reescribir desde cero.
- Marcar cada habilidad de la vacante así: **🏷️ [Habilidad: X]**, explicando qué es, por qué se hace así y cómo contarlo en una entrevista.
- Johan prefiere **una conversación por tema/fase**.
- Johan viene de **Java, Python y Flask** (hizo una API REST CRUD en Flask): usar comparaciones con Java cuando ayuden.
- Entorno: Windows 11 Pro, 16 GB RAM, Ryzen 7 7730U, WSL2 Ubuntu (usuario `johan_zuleta`, UID 1000).
- Actualizar este documento (estado de fases y checklists) cuando se complete una etapa.

---

## 🔄 Cómo retomar en una conversación nueva

Escribir algo como:

> *"Vamos a continuar el plan de PHP/Laravel. El repositorio es `johandanielz/php-poo` y el plan está en `docs/PLAN.md`. Seguimos con [etapa]."*

Claude puede leer el repositorio (y este archivo) una vez conectado a la conversación.

---

## 📈 Registro de avance

| Fecha | Hito |
|---|---|
| 2026-10-27 | Plan de estudio inicial |
| 2026-10-30 | Plan ampliado (Laravel 12, Git avanzado, Docker, Jobs, migraciones, Eloquent, patrones) |
| 2026-10-30 | Fase 0 completada: entorno limpio con WSL2, Docker, Git y SSH |
| 2026-10-30 | Fase 1.0 completada: Dev Container + PR #1 mergeado |
| 2026-11-03 | Plan documentado en `docs/PLAN.md` |
