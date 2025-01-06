# Guide sur le Hashage des Mots de Passe

## Hashage des Mots de Passe : Obligatoire !
### Pourquoi le Hashage est Essentiel
Le hashage des mots de passe est une pratique indispensable pour la sécurité des bases de données. Il est crucial de **ne jamais stocker un mot de passe en clair** afin de protéger les utilisateurs contre des accès non autorisés.

### Stockage des Empreintes Hashées
Dans la base de données, ce n’est pas le mot de passe en clair qui est stocké, mais son **empreinte numérique (hash)**. Cette empreinte est une combinaison des éléments suivants :

- **Algorithme**
- **Options de l'algorithme**
- **Sel (Salt)**
- **Mot de passe hashé**

Le tout génère une chaîne d'environ **80 à 100 caractères**, d'où la recommandation d'utiliser un champ **VARCHAR(255)** pour stocker les mots de passe.

---

## Catégories d'Algorithmes de Hashage
### Algorithmes Faibles (À Éviter)
- **MD5**
- **SHA-256**

### Algorithmes Forts (Recommandés)
- **Argon2i**

---

## Failles et Attaques Courantes
1. **XSS (Cross-Site Scripting)** : Injections de code malveillant via les formulaires.
2. **CSRF (Cross-Site Request Forgery)** : Falsification de requêtes inter-site.
   - **Solution** : Utiliser un système de **jetons (tokens)**.
3. **Injections SQL** : Exécution de commandes SQL malveillantes.
   - **Solution** : Utiliser des requêtes **préparées**.
4. **Attaque par Force Brute** : Tentatives aléatoires utilisant des algorithmes puissants et des itérations.
5. **Attaque par Dictionnaire** : Utilisation d’une liste de mots de passe communs.

---

## Solutions de Sécurité
- Suivre les recommandations de la **CNIL** :
  - Utiliser des mots de passe d'au moins **12 caractères**.
  - Préférer des mots de passe complexes contenant des **majuscules, chiffres, caractères spéciaux** pour maximiser l'entropie.

### Expressions Régulières (Regex)
Les expressions régulières permettent de définir des modèles pour valider des chaînes de caractères (comme les mots de passe).

---

## Points Critiques
- **Attention** : Ne jamais déléguer entièrement la sécurité d'une application au framework utilisé.

### Vérification des Mots de Passe
La fonction `password_verify` permet de vérifier si le mot de passe fourni correspond au hash stocké dans la base de données.

---

