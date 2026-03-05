from flask import jsonify, request, current_app
from models import User, Post, db
from functools import wraps


TOKEN_SECRETO = "miclave123"

def require_token(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        token = request.headers.get("Authorization")
        if token != f"Token {TOKEN_SECRETO}":
            return jsonify({"error": "No autorizado"}), 401
        return f(*args, **kwargs)
    return decorated


def register_routes(app):
    @app.route('/api/usuarios_flask', methods=['GET'])
    @require_token
    def get_users():
        users = User.query.all()
        return jsonify([
            {
                'id': u.id,
                'name': u.name,
                'email': u.email
            }
            for u in users
        ])

    @app.route('/api/usuarios_flask/<int:id>', methods=['GET'])
    @require_token
    def get_user(id):
        user = User.query.get_or_404(id)
        return jsonify({
            'id': user.id,
            'name': user.name
        })

    @app.route('/api/usuarios_flask', methods=['POST'])
    @require_token
    def create_user():
        data = request.get_json()
        
        if not data or 'name' not in data or 'email' not in data:
            return jsonify({'error': 'Missing fields'}), 400
        
        new_user = User(name=data['name'], email=data['email'])
        db.session.add(new_user)
        db.session.commit()
        
        return jsonify({'id': new_user.id, 'name': new_user.name}), 201

    @app.route('/api/usuarios_flask/<int:id>', methods=['DELETE'])
    @require_token
    def delete_user(id):
        user = User.query.get_or_404(id)
        db.session.delete(user)
        db.session.commit()
        return jsonify({'message': 'User deleted'}), 204

    @app.route('/api/usuarios_flask/<int:id>', methods=['PUT'])
    @require_token
    def update_user(id):
        user = User.query.get_or_404(id)
        data = request.get_json()
        user.name = data.get('name', user.name)
        user.email = data.get('email', user.email)
        db.session.commit()
        return jsonify({'message': 'User updated'})
    
    @app.route('/api/posts', methods=['GET'])
    @require_token
    def get_posts():
        posts = Post.query.all()
        return jsonify([p.to_dict() for p in posts])

    @app.route('/api/posts', methods=['POST'])
    @require_token
    def create_post():
        data = request.get_json()
        new_post = Post(
            title=data['title'],
            content=data['content'],
            published=data.get('published', False),
            user_id=data['user_id']
        )
        db.session.add(new_post)
        db.session.commit()
        return jsonify(new_post.to_dict()), 201 