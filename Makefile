.PHONY: start stop restart switch-from-main switch-to-main logs logs-mysql logs-phpmyadmin status clean help

# Commande principale : arrête main-app-v3 et démarre artbox
switch-from-main:
	@echo "🔄 Arrêt des containers de main-app-v3..."
	@docker stop mysql 2>/dev/null || echo "⚠️  Container mysql déjà arrêté"
	@docker stop backend 2>/dev/null || echo "⚠️  Container backend déjà arrêté"
	@echo "🚀 Démarrage de l'environnement artbox..."
	@docker-compose up -d
	@echo "⏳ Attente de l'initialisation de MySQL (30 secondes)..."
	@sleep 30
	@echo "✅ Environnement artbox démarré !"
	@echo ""
	@echo "📍 Accès aux services :"
	@echo "   - Site web     : http://localhost:8000"
	@echo "   - phpMyAdmin   : http://localhost:8080"
	@echo "   - User         : artbox_user"
	@echo "   - Password     : artbox_password"

# Commande inverse : arrête artbox et démarre main-app-v3
switch-to-main:
	@echo "🔄 Arrêt de l'environnement artbox..."
	@docker-compose down
	@echo "🚀 Démarrage des containers main-app-v3..."
	@docker start mysql backend 2>/dev/null || echo "⚠️  Containers main-app-v3 introuvables"
	@echo "✅ Environnement main-app-v3 redémarré !"

# Démarrer l'environnement artbox (sans arrêter main-app-v3)
start:
	@echo "🚀 Démarrage de l'environnement artbox..."
	@docker-compose up -d
	@echo "⏳ Attente de l'initialisation (30 secondes)..."
	@sleep 30
	@echo "✅ Environnement artbox démarré !"

# Arrêter l'environnement artbox
stop:
	@echo "🛑 Arrêt de l'environnement artbox..."
	@docker-compose down
	@echo "✅ Environnement artbox arrêté"

# Redémarrer l'environnement artbox
restart:
	@echo "🔄 Redémarrage de l'environnement artbox..."
	@docker-compose restart
	@echo "✅ Environnement artbox redémarré"

# Voir les logs de tous les services
logs:
	@docker-compose logs -f

# Voir les logs MySQL uniquement
logs-mysql:
	@docker-compose logs -f mysql

# Voir les logs phpMyAdmin uniquement
logs-phpmyadmin:
	@docker-compose logs -f phpmyadmin

# Voir l'état des containers
status:
	@echo "📊 État des containers artbox :"
	@docker-compose ps

# Nettoyer complètement (⚠️ supprime les données de la base)
clean:
	@echo "⚠️  ATTENTION : Cette commande va supprimer toutes les données !"
	@read -p "Êtes-vous sûr ? [y/N] " -n 1 -r; \
	echo; \
	if [[ $$REPLY =~ ^[Yy]$$ ]]; then \
		echo "🗑️  Suppression de l'environnement artbox..."; \
		docker-compose down -v; \
		echo "✅ Nettoyage terminé"; \
	else \
		echo "❌ Annulé"; \
	fi

# Afficher l'aide
help:
	@echo "📖 Commandes disponibles pour le projet artbox :"
	@echo ""
	@echo "  make switch-from-main  - Arrête main-app-v3 et démarre artbox"
	@echo "  make switch-to-main    - Arrête artbox et redémarre main-app-v3"
	@echo "  make start            - Démarre l'environnement artbox"
	@echo "  make stop             - Arrête l'environnement artbox"
	@echo "  make restart          - Redémarre l'environnement artbox"
	@echo "  make logs             - Affiche les logs (tous les services)"
	@echo "  make logs-mysql       - Affiche les logs MySQL uniquement"
	@echo "  make logs-phpmyadmin  - Affiche les logs phpMyAdmin uniquement"
	@echo "  make status           - Affiche l'état des containers"
	@echo "  make clean            - Supprime complètement l'environnement"
	@echo "  make help             - Affiche cette aide"
