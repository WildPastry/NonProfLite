window.onload = function () {
    var g = new Games.SpaceInvaders();
};

var Games;
(function (Games) {
    var SpaceInvaders = (function () {
        //private testEmitter: Particles.Emitter;
        //private testEmitter2: Particles.Emitter;
        //private areaEmitter: Particles.AreaEmitter;
        function SpaceInvaders() {
            this.initialize();
        }
        SpaceInvaders.prototype.initialize = function () {
            var _this = this;
            this.canvas = document.getElementById("canvas");

            this.player = new Players.Player(this, new Vectors.Vector2D(234, 20), "https://s.put.re/3Xep9w2i.png");
            this.enemy = new Enemies.Tank(this, new Vectors.Vector2D(20, 450), this.player, "");

            this.completed = false;

            this.drawToken = setInterval(function () {
                return _this.draw();
            }, 25);
            this.updateToken = setInterval(function () {
                return _this.update();
            }, 25);
        };

        SpaceInvaders.prototype.update = function () {
            //this.testEmitter.update();
            //this.testEmitter2.update();
            //this.areaEmitter.update();
            this.player.update();
            this.enemy.update();
        };

        SpaceInvaders.prototype.draw = function () {
            var ctx;
            ctx = this.canvas.getContext("2d");
            ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

            ctx.fillStyle = "#000";
            ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

            if (this.completed) {
                ctx.fillStyle = "#fff";
                ctx.fillText("complete", 200, 200);
            } else if (this.player.getdead()) {
                ctx.fillStyle = "#f00";
                ctx.fillText("game over", 200, 200);
            } else {
                this.player.draw(ctx);
                this.enemy.draw(ctx);
            }
        };

        SpaceInvaders.prototype.increment = function () {
            this.enemy.increment();
        };

        SpaceInvaders.prototype.complete = function () {
            this.completed = true;
        };
        return SpaceInvaders;
    })();
    Games.SpaceInvaders = SpaceInvaders;
})(Games || (Games = {}));

var Players;
(function (Players) {
    var Player = (function () {
        function Player(game, position, spriteurl) {
            var _this = this;
            this.position = position;
            this.sprite = this.loadImage(spriteurl);
            this.speed = 5;

            this.dropHeight = 48;

            this.targetEdge = 0;

            this.width = 32;
            this.height = 32;
            this.padding = 20;

            this.game = game;

            this.dead = false;

            document.addEventListener("keydown", function (ev) {
                return _this.keyInput(ev);
            });
        }
        Player.prototype.update = function () {
            var hit0 = false;
            var hit1 = false;

            if ((this.position.x - (this.width / 2)) - this.padding < 0) {
                this.position.x = (this.width / 2) + this.padding;
                hit0 = true;
            } else if ((this.position.x + (this.width / 2)) + this.padding >= 500) {
                this.position.x = 500 - (this.width / 2) - this.padding;
                hit1 = true;
            }

            if (hit0 && this.targetEdge < 1) {
                this.position.y += this.dropHeight;
                this.targetEdge = 1;
                this.game.increment();
            }

            if (hit1 && this.targetEdge > -1) {
                this.position.y += this.dropHeight;
                this.targetEdge = -1;
                this.game.increment();
            }

            if (this.position.y + (this.height / 2) > 500 - this.dropHeight) {
                this.game.complete();
            }
        };

        Player.prototype.draw = function (ctx) {
            ctx.drawImage(this.sprite, this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
        };

        Player.prototype.keyInput = function (event) {
            switch (event.keyCode) {
                case 87:
                case 119:
                    break;
                case 65:
                case 97:
                    this.position.x -= this.speed;
                    break;
                case 83:
                case 115:
                    break;
                case 68:
                case 100:
                    this.position.x += this.speed;
                    break;
                default:
                    break;
            }
        };

        Player.prototype.getpos = function () {
            return this.position;
        };

        Player.prototype.getdead = function () {
            return this.dead;
        };

        Player.prototype.boundingbox = function () {
            return new Area.RectArea(this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
        };

        Player.prototype.hit = function () {
            this.dead = true;
        };

        Player.prototype.loadImage = function (src) {
            var img = new Image();
            img.src = src;

            return img;
        };
        return Player;
    })();
    Players.Player = Player;
})(Players || (Players = {}));

var Enemies;
(function (Enemies) {
    var Tank = (function () {
        function Tank(game, position, player, spriteurl) {
            this.game = game;
            this.player = player;
            this.position = position;
            this.sprite = this.loadImage(spriteurl);
            this.speed = 0.01;

            this.bullet = null;
        }
        Tank.prototype.update = function () {
            this.position.x = Maths.lerp(this.position.x, this.player.getpos().x, this.speed);

            if (this.bullet == null && Math.abs(this.position.x - this.player.getpos().x) < 100) {
                var targets = [];
                targets.push(this.player);

                this.bullet = new Projectile.Bullet(new Vectors.Vector2D(this.position.x, this.position.y - 5), new Vectors.Vector2D(0, -1), 3.0, targets);
            }

            if (this.bullet != null) {
                this.bullet.update();

                if (this.bullet.hit || this.bullet.getpos().y < 0) {
                    this.bullet = null;
                }
            }
        };

        Tank.prototype.draw = function (ctx) {
            ctx.fillStyle = "#fff";
            ctx.fillRect(this.position.x - 12.5, this.position.y - 12.5, 25, 25);

            if (this.bullet != null) {
                this.bullet.draw(ctx);
            }
        };

        Tank.prototype.increment = function () {
            this.speed += 0.005;
        };

        Tank.prototype.loadImage = function (src) {
            var img = new Image();
            img.src = src;

            return img;
        };
        return Tank;
    })();
    Enemies.Tank = Tank;
})(Enemies || (Enemies = {}));

var Projectile;
(function (Projectile) {
    var Bullet = (function () {
        function Bullet(position, direction, speed, targets) {
            this.position = position;
            this.direction = direction;
            this.targets = targets;
            this.speed = speed;
            this.hit = false;

            this.emitter = new Particles.Emitter(10, 25, new Vectors.Vector2D(this.position.x, this.position.y), new Vectors.Vector2D(0, 1), "https://s.put.re/dmmTenbz.png");
        }
        Bullet.prototype.update = function () {
            this.position.x += this.direction.x * this.speed;
            this.position.y += this.direction.y * this.speed;

            this.emitter.pos = new Vectors.Vector2D(this.position.x, this.position.y);

            this.emitter.update();

            this.checkCollisions();

            this.speed += 0.05;
        };

        Bullet.prototype.checkCollisions = function () {
            var _this = this;
            this.targets.forEach(function (t) {
                var collider = t.boundingbox();

                if (collider.contains(_this.position)) {
                    t.hit();
                    _this.hit = true;
                }
            });
        };

        Bullet.prototype.draw = function (ctx) {
            ctx.fillStyle = "#fff";
            ctx.fillRect(this.position.x, this.position.y, 2, 5);

            this.emitter.draw(ctx);
        };

        Bullet.prototype.getpos = function () {
            return this.position;
        };
        return Bullet;
    })();
    Projectile.Bullet = Bullet;
})(Projectile || (Projectile = {}));

var Particles;
(function (Particles) {
    var AreaEmitter = (function () {
        function AreaEmitter(minPartices, maxParticles, area, imagesrc) {
            if (typeof imagesrc === "undefined") { imagesrc = ""; }
            this.area = new Area.RectArea(area.x, area.y, area.width, area.height);

            this.minParticles = minPartices;
            this.maxParticles = maxParticles;

            this.particles = [];

            if (imagesrc != "") {
                this.image = this.loadImage(imagesrc);
            } else {
                this.image = null;
            }
        }
        AreaEmitter.prototype.addparticle = function () {
            this.particles.push(new Particle(this.area.getPoint(), new Vectors.Vector2D(0, 1), 2500, 5000, 5, 7.5, 7.5, 10, 20, 20, 20, 20, this.image));
        };

        AreaEmitter.prototype.update = function () {
            var _this = this;
            if (this.particles.length < this.maxParticles) {
                this.addparticle();
            }

            var inactive;
            inactive = [];

            this.particles.forEach(function (p) {
                if (p.active()) {
                    p.update();
                } else {
                    inactive.push(p);
                }
            });

            inactive.forEach(function (i) {
                _this.particles.splice(_this.particles.indexOf(i), 1);
            });
        };

        AreaEmitter.prototype.draw = function (ctx) {
            //console.log(this.particles.length);
            this.particles.forEach(function (p) {
                console.log(p);

                p.draw(ctx);
            });
        };

        AreaEmitter.prototype.loadImage = function (src) {
            var img = new Image();
            img.src = src;

            return img;
        };
        return AreaEmitter;
    })();
    Particles.AreaEmitter = AreaEmitter;

    var Emitter = (function () {
        function Emitter(minPartices, maxParticles, pos, emitDir, imagesrc) {
            if (typeof imagesrc === "undefined") { imagesrc = ""; }
            this.pos = new Vectors.Vector2D(pos.x, pos.y);
            this.dir = new Vectors.Vector2D(0, 0);

            emitDir.normalize();
            this.emitDir = emitDir;

            this.minParticles = minPartices;
            this.maxParticles = maxParticles;

            this.particles = [];

            if (imagesrc != "") {
                this.image = this.loadImage(imagesrc);
            } else {
                this.image = null;
            }
        }
        Emitter.prototype.addparticle = function () {
            this.particles.push(new Particle(new Vectors.Vector2D(this.pos.x, this.pos.y), new Vectors.Vector2D(this.emitDir.x + (Math.random() * 2 - 1), this.emitDir.y + (Math.random() * 2 - 1)), 500, 1000, 0.5, 1.0, 0.1, 0.2, 1, 5, 3, 8, this.image));
        };

        Emitter.prototype.update = function () {
            var _this = this;
            if (this.particles.length < this.maxParticles) {
                this.addparticle();
            }

            var inactive;
            inactive = [];

            this.particles.forEach(function (p) {
                if (p.active()) {
                    p.update();
                } else {
                    inactive.push(p);
                }
            });

            inactive.forEach(function (i) {
                _this.particles.splice(_this.particles.indexOf(i), 1);
            });
        };

        Emitter.prototype.draw = function (ctx) {
            this.particles.forEach(function (p) {
                p.draw(ctx);
            });
        };

        Emitter.prototype.loadImage = function (src) {
            var img = new Image();
            img.src = src;

            return img;
        };
        return Emitter;
    })();
    Particles.Emitter = Emitter;

    var Particle = (function () {
        function Particle(pos, dir, minlifespan, maxlifespan, minstartspeed, maxstartspeed, minendspeed, maxendspeed, minstartsize, maxstartsize, minendsize, maxendsize, img) {
            if (typeof img === "undefined") { img = null; }
            this.pos = pos;

            dir.normalize();
            this.dir = dir;

            this.spawned = new Date().getTime();
            this.lifespan = Maths.lerp(minlifespan, maxlifespan, Math.random());

            this.startspeed = Maths.lerp(minstartspeed, maxstartspeed, Math.random());
            this.endspeed = Maths.lerp(minendspeed, maxendspeed, Math.random());

            this.startsize = Maths.lerp(minstartsize, maxstartsize, Math.random());
            this.endsize = Maths.lerp(minendsize, maxendsize, Math.random());

            this.image = img;
        }
        Particle.prototype.active = function () {
            return this.age() < 1;
        };

        Particle.prototype.update = function () {
            this.pos.x += this.dir.x * Maths.lerp(this.startspeed, this.endspeed, this.age());
            this.pos.y += this.dir.y * Maths.lerp(this.startspeed, this.endspeed, this.age());
        };

        Particle.prototype.draw = function (ctx) {
            var currentsize = Maths.lerp(this.startsize, this.endsize, this.age());
            var offset = currentsize / 2;

            if (this.image == null) {
                ctx.fillRect(this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
            } else {
                ctx.drawImage(this.image, this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
            }
        };

        Particle.prototype.age = function () {
            var timeactive = new Date().getTime() - this.spawned;
            return timeactive / this.lifespan;
        };
        return Particle;
    })();
    Particles.Particle = Particle;
})(Particles || (Particles = {}));

var Area;
(function (Area) {
    var LineArea = (function () {
        function LineArea(from, to) {
            this.from = from;
            this.to = to;
        }
        LineArea.prototype.contains = function (v0) {
            return true;
        };

        LineArea.prototype.getPoint = function () {
            return new Vectors.Vector2D(0, 0);
        };
        return LineArea;
    })();
    Area.LineArea = LineArea;

    var RectArea = (function () {
        function RectArea(x, y, width, height) {
            this.x = x;
            this.y = y;
            this.width = width;
            this.height = height;
        }
        RectArea.prototype.contains = function (v0) {
            if (v0.x < this.x)
                return false;
            if (v0.y < this.y)
                return false;
            if (v0.x > this.x + this.width)
                return false;
            if (v0.y > this.y + this.height)
                return false;

            return true;
        };

        RectArea.prototype.getPoint = function () {
            return new Vectors.Vector2D(Maths.lerp(this.x, this.x + this.width, Math.random()), Maths.lerp(this.y, this.y + this.height, Math.random()));
        };
        return RectArea;
    })();
    Area.RectArea = RectArea;
})(Area || (Area = {}));

var Vectors;
(function (Vectors) {
    var Vector2D = (function () {
        function Vector2D(x, y) {
            this.x = x;
            this.y = y;
            this.x = x;
            this.y = y;
        }
        Vector2D.prototype.length = function () {
            return Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2));
        };

        Vector2D.prototype.normalize = function () {
            var length = this.length();

            this.x = this.x / length;
            this.y = this.y / length;
        };

        Vector2D.Add = function (v0, v1) {
            return new Vector2D(v0.x + v1.x, v0.y + v1.y);
        };

        Vector2D.Multiply = function (v0, v) {
            return new Vector2D(v0.x * v, v0.y * v);
        };

        Vector2D.Lerp = function (v0, v1, amount) {
            return Vector2D.Add(v1, Vector2D.Multiply(new Vector2D(v1.x - v0.x, v1.y - v0.y), amount));
        };
        return Vector2D;
    })();
    Vectors.Vector2D = Vector2D;
})(Vectors || (Vectors = {}));

var Maths = (function () {
    function Maths() {
    }
    Maths.lerp = function (v0, v1, t) {
        return v0 + (v1 - v0) * t;
    };
    return Maths;
})();
//@ sourceMappingURL=particle.js.map
//codepen.io/daniel-j-lewis/pen/HmxzJ
window.onload = function () {
	var g = new Games.SpaceInvaders();
};

var Games;
(function (Games) {
	var SpaceInvaders = (function () {
			//private testEmitter: Particles.Emitter;
			//private testEmitter2: Particles.Emitter;
			//private areaEmitter: Particles.AreaEmitter;
			function SpaceInvaders() {
					this.initialize();
			}
			SpaceInvaders.prototype.initialize = function () {
					var _this = this;
					this.canvas = document.getElementById("canvas");

					this.player = new Players.Player(this, new Vectors.Vector2D(234, 20), "https://s.put.re/3Xep9w2i.png");
					this.enemy = new Enemies.Tank(this, new Vectors.Vector2D(20, 450), this.player, "");

					this.completed = false;

					this.drawToken = setInterval(function () {
							return _this.draw();
					}, 25);
					this.updateToken = setInterval(function () {
							return _this.update();
					}, 25);
			};

			SpaceInvaders.prototype.update = function () {
					//this.testEmitter.update();
					//this.testEmitter2.update();
					//this.areaEmitter.update();
					this.player.update();
					this.enemy.update();
			};

			SpaceInvaders.prototype.draw = function () {
					var ctx;
					ctx = this.canvas.getContext("2d");
					ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

					ctx.fillStyle = "#000";
					ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

					if (this.completed) {
							ctx.fillStyle = "#fff";
							ctx.fillText("complete", 200, 200);
					} else if (this.player.getdead()) {
							ctx.fillStyle = "#f00";
							ctx.fillText("game over", 200, 200);
					} else {
							this.player.draw(ctx);
							this.enemy.draw(ctx);
					}
			};

			SpaceInvaders.prototype.increment = function () {
					this.enemy.increment();
			};

			SpaceInvaders.prototype.complete = function () {
					this.completed = true;
			};
			return SpaceInvaders;
	})();
	Games.SpaceInvaders = SpaceInvaders;
})(Games || (Games = {}));

var Players;
(function (Players) {
	var Player = (function () {
			function Player(game, position, spriteurl) {
					var _this = this;
					this.position = position;
					this.sprite = this.loadImage(spriteurl);
					this.speed = 5;

					this.dropHeight = 48;

					this.targetEdge = 0;

					this.width = 32;
					this.height = 32;
					this.padding = 20;

					this.game = game;

					this.dead = false;

					document.addEventListener("keydown", function (ev) {
							return _this.keyInput(ev);
					});
			}
			Player.prototype.update = function () {
					var hit0 = false;
					var hit1 = false;

					if ((this.position.x - (this.width / 2)) - this.padding < 0) {
							this.position.x = (this.width / 2) + this.padding;
							hit0 = true;
					} else if ((this.position.x + (this.width / 2)) + this.padding >= 500) {
							this.position.x = 500 - (this.width / 2) - this.padding;
							hit1 = true;
					}

					if (hit0 && this.targetEdge < 1) {
							this.position.y += this.dropHeight;
							this.targetEdge = 1;
							this.game.increment();
					}

					if (hit1 && this.targetEdge > -1) {
							this.position.y += this.dropHeight;
							this.targetEdge = -1;
							this.game.increment();
					}

					if (this.position.y + (this.height / 2) > 500 - this.dropHeight) {
							this.game.complete();
					}
			};

			Player.prototype.draw = function (ctx) {
					ctx.drawImage(this.sprite, this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
			};

			Player.prototype.keyInput = function (event) {
					switch (event.keyCode) {
							case 87:
							case 119:
									break;
							case 65:
							case 97:
									this.position.x -= this.speed;
									break;
							case 83:
							case 115:
									break;
							case 68:
							case 100:
									this.position.x += this.speed;
									break;
							default:
									break;
					}
			};

			Player.prototype.getpos = function () {
					return this.position;
			};

			Player.prototype.getdead = function () {
					return this.dead;
			};

			Player.prototype.boundingbox = function () {
					return new Area.RectArea(this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
			};

			Player.prototype.hit = function () {
					this.dead = true;
			};

			Player.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Player;
	})();
	Players.Player = Player;
})(Players || (Players = {}));

var Enemies;
(function (Enemies) {
	var Tank = (function () {
			function Tank(game, position, player, spriteurl) {
					this.game = game;
					this.player = player;
					this.position = position;
					this.sprite = this.loadImage(spriteurl);
					this.speed = 0.01;

					this.bullet = null;
			}
			Tank.prototype.update = function () {
					this.position.x = Maths.lerp(this.position.x, this.player.getpos().x, this.speed);

					if (this.bullet == null && Math.abs(this.position.x - this.player.getpos().x) < 100) {
							var targets = [];
							targets.push(this.player);

							this.bullet = new Projectile.Bullet(new Vectors.Vector2D(this.position.x, this.position.y - 5), new Vectors.Vector2D(0, -1), 3.0, targets);
					}

					if (this.bullet != null) {
							this.bullet.update();

							if (this.bullet.hit || this.bullet.getpos().y < 0) {
									this.bullet = null;
							}
					}
			};

			Tank.prototype.draw = function (ctx) {
					ctx.fillStyle = "#fff";
					ctx.fillRect(this.position.x - 12.5, this.position.y - 12.5, 25, 25);

					if (this.bullet != null) {
							this.bullet.draw(ctx);
					}
			};

			Tank.prototype.increment = function () {
					this.speed += 0.005;
			};

			Tank.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Tank;
	})();
	Enemies.Tank = Tank;
})(Enemies || (Enemies = {}));

var Projectile;
(function (Projectile) {
	var Bullet = (function () {
			function Bullet(position, direction, speed, targets) {
					this.position = position;
					this.direction = direction;
					this.targets = targets;
					this.speed = speed;
					this.hit = false;

					this.emitter = new Particles.Emitter(10, 25, new Vectors.Vector2D(this.position.x, this.position.y), new Vectors.Vector2D(0, 1), "https://s.put.re/dmmTenbz.png");
			}
			Bullet.prototype.update = function () {
					this.position.x += this.direction.x * this.speed;
					this.position.y += this.direction.y * this.speed;

					this.emitter.pos = new Vectors.Vector2D(this.position.x, this.position.y);

					this.emitter.update();

					this.checkCollisions();

					this.speed += 0.05;
			};

			Bullet.prototype.checkCollisions = function () {
					var _this = this;
					this.targets.forEach(function (t) {
							var collider = t.boundingbox();

							if (collider.contains(_this.position)) {
									t.hit();
									_this.hit = true;
							}
					});
			};

			Bullet.prototype.draw = function (ctx) {
					ctx.fillStyle = "#fff";
					ctx.fillRect(this.position.x, this.position.y, 2, 5);

					this.emitter.draw(ctx);
			};

			Bullet.prototype.getpos = function () {
					return this.position;
			};
			return Bullet;
	})();
	Projectile.Bullet = Bullet;
})(Projectile || (Projectile = {}));

var Particles;
(function (Particles) {
	var AreaEmitter = (function () {
			function AreaEmitter(minPartices, maxParticles, area, imagesrc) {
					if (typeof imagesrc === "undefined") { imagesrc = ""; }
					this.area = new Area.RectArea(area.x, area.y, area.width, area.height);

					this.minParticles = minPartices;
					this.maxParticles = maxParticles;

					this.particles = [];

					if (imagesrc != "") {
							this.image = this.loadImage(imagesrc);
					} else {
							this.image = null;
					}
			}
			AreaEmitter.prototype.addparticle = function () {
					this.particles.push(new Particle(this.area.getPoint(), new Vectors.Vector2D(0, 1), 2500, 5000, 5, 7.5, 7.5, 10, 20, 20, 20, 20, this.image));
			};

			AreaEmitter.prototype.update = function () {
					var _this = this;
					if (this.particles.length < this.maxParticles) {
							this.addparticle();
					}

					var inactive;
					inactive = [];

					this.particles.forEach(function (p) {
							if (p.active()) {
									p.update();
							} else {
									inactive.push(p);
							}
					});

					inactive.forEach(function (i) {
							_this.particles.splice(_this.particles.indexOf(i), 1);
					});
			};

			AreaEmitter.prototype.draw = function (ctx) {
					//console.log(this.particles.length);
					this.particles.forEach(function (p) {
							console.log(p);

							p.draw(ctx);
					});
			};

			AreaEmitter.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return AreaEmitter;
	})();
	Particles.AreaEmitter = AreaEmitter;

	var Emitter = (function () {
			function Emitter(minPartices, maxParticles, pos, emitDir, imagesrc) {
					if (typeof imagesrc === "undefined") { imagesrc = ""; }
					this.pos = new Vectors.Vector2D(pos.x, pos.y);
					this.dir = new Vectors.Vector2D(0, 0);

					emitDir.normalize();
					this.emitDir = emitDir;

					this.minParticles = minPartices;
					this.maxParticles = maxParticles;

					this.particles = [];

					if (imagesrc != "") {
							this.image = this.loadImage(imagesrc);
					} else {
							this.image = null;
					}
			}
			Emitter.prototype.addparticle = function () {
					this.particles.push(new Particle(new Vectors.Vector2D(this.pos.x, this.pos.y), new Vectors.Vector2D(this.emitDir.x + (Math.random() * 2 - 1), this.emitDir.y + (Math.random() * 2 - 1)), 500, 1000, 0.5, 1.0, 0.1, 0.2, 1, 5, 3, 8, this.image));
			};

			Emitter.prototype.update = function () {
					var _this = this;
					if (this.particles.length < this.maxParticles) {
							this.addparticle();
					}

					var inactive;
					inactive = [];

					this.particles.forEach(function (p) {
							if (p.active()) {
									p.update();
							} else {
									inactive.push(p);
							}
					});

					inactive.forEach(function (i) {
							_this.particles.splice(_this.particles.indexOf(i), 1);
					});
			};

			Emitter.prototype.draw = function (ctx) {
					this.particles.forEach(function (p) {
							p.draw(ctx);
					});
			};

			Emitter.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Emitter;
	})();
	Particles.Emitter = Emitter;

	var Particle = (function () {
			function Particle(pos, dir, minlifespan, maxlifespan, minstartspeed, maxstartspeed, minendspeed, maxendspeed, minstartsize, maxstartsize, minendsize, maxendsize, img) {
					if (typeof img === "undefined") { img = null; }
					this.pos = pos;

					dir.normalize();
					this.dir = dir;

					this.spawned = new Date().getTime();
					this.lifespan = Maths.lerp(minlifespan, maxlifespan, Math.random());

					this.startspeed = Maths.lerp(minstartspeed, maxstartspeed, Math.random());
					this.endspeed = Maths.lerp(minendspeed, maxendspeed, Math.random());

					this.startsize = Maths.lerp(minstartsize, maxstartsize, Math.random());
					this.endsize = Maths.lerp(minendsize, maxendsize, Math.random());

					this.image = img;
			}
			Particle.prototype.active = function () {
					return this.age() < 1;
			};

			Particle.prototype.update = function () {
					this.pos.x += this.dir.x * Maths.lerp(this.startspeed, this.endspeed, this.age());
					this.pos.y += this.dir.y * Maths.lerp(this.startspeed, this.endspeed, this.age());
			};

			Particle.prototype.draw = function (ctx) {
					var currentsize = Maths.lerp(this.startsize, this.endsize, this.age());
					var offset = currentsize / 2;

					if (this.image == null) {
							ctx.fillRect(this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
					} else {
							ctx.drawImage(this.image, this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
					}
			};

			Particle.prototype.age = function () {
					var timeactive = new Date().getTime() - this.spawned;
					return timeactive / this.lifespan;
			};
			return Particle;
	})();
	Particles.Particle = Particle;
})(Particles || (Particles = {}));

var Area;
(function (Area) {
	var LineArea = (function () {
			function LineArea(from, to) {
					this.from = from;
					this.to = to;
			}
			LineArea.prototype.contains = function (v0) {
					return true;
			};

			LineArea.prototype.getPoint = function () {
					return new Vectors.Vector2D(0, 0);
			};
			return LineArea;
	})();
	Area.LineArea = LineArea;

	var RectArea = (function () {
			function RectArea(x, y, width, height) {
					this.x = x;
					this.y = y;
					this.width = width;
					this.height = height;
			}
			RectArea.prototype.contains = function (v0) {
					if (v0.x < this.x)
							return false;
					if (v0.y < this.y)
							return false;
					if (v0.x > this.x + this.width)
							return false;
					if (v0.y > this.y + this.height)
							return false;

					return true;
			};

			RectArea.prototype.getPoint = function () {
					return new Vectors.Vector2D(Maths.lerp(this.x, this.x + this.width, Math.random()), Maths.lerp(this.y, this.y + this.height, Math.random()));
			};
			return RectArea;
	})();
	Area.RectArea = RectArea;
})(Area || (Area = {}));

var Vectors;
(function (Vectors) {
	var Vector2D = (function () {
			function Vector2D(x, y) {
					this.x = x;
					this.y = y;
					this.x = x;
					this.y = y;
			}
			Vector2D.prototype.length = function () {
					return Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2));
			};

			Vector2D.prototype.normalize = function () {
					var length = this.length();

					this.x = this.x / length;
					this.y = this.y / length;
			};

			Vector2D.Add = function (v0, v1) {
					return new Vector2D(v0.x + v1.x, v0.y + v1.y);
			};

			Vector2D.Multiply = function (v0, v) {
					return new Vector2D(v0.x * v, v0.y * v);
			};

			Vector2D.Lerp = function (v0, v1, amount) {
					return Vector2D.Add(v1, Vector2D.Multiply(new Vector2D(v1.x - v0.x, v1.y - v0.y), amount));
			};
			return Vector2D;
	})();
	Vectors.Vector2D = Vector2D;
})(Vectors || (Vectors = {}));

var Maths = (function () {
	function Maths() {
	}
	Maths.lerp = function (v0, v1, t) {
			return v0 + (v1 - v0) * t;
	};
	return Maths;
})();
//@ sourceMappingURL=particle.js.map
//codepen.io/daniel-j-lewis/pen/HmxzJ
window.onload = function () {
	var g = new Games.SpaceInvaders();
};

var Games;
(function (Games) {
	var SpaceInvaders = (function () {
			//private testEmitter: Particles.Emitter;
			//private testEmitter2: Particles.Emitter;
			//private areaEmitter: Particles.AreaEmitter;
			function SpaceInvaders() {
					this.initialize();
			}
			SpaceInvaders.prototype.initialize = function () {
					var _this = this;
					this.canvas = document.getElementById("canvas");

					this.player = new Players.Player(this, new Vectors.Vector2D(234, 20), "https://s.put.re/3Xep9w2i.png");
					this.enemy = new Enemies.Tank(this, new Vectors.Vector2D(20, 450), this.player, "");

					this.completed = false;

					this.drawToken = setInterval(function () {
							return _this.draw();
					}, 25);
					this.updateToken = setInterval(function () {
							return _this.update();
					}, 25);
			};

			SpaceInvaders.prototype.update = function () {
					//this.testEmitter.update();
					//this.testEmitter2.update();
					//this.areaEmitter.update();
					this.player.update();
					this.enemy.update();
			};

			SpaceInvaders.prototype.draw = function () {
					var ctx;
					ctx = this.canvas.getContext("2d");
					ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

					ctx.fillStyle = "#000";
					ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

					if (this.completed) {
							ctx.fillStyle = "#fff";
							ctx.fillText("complete", 200, 200);
					} else if (this.player.getdead()) {
							ctx.fillStyle = "#f00";
							ctx.fillText("game over", 200, 200);
					} else {
							this.player.draw(ctx);
							this.enemy.draw(ctx);
					}
			};

			SpaceInvaders.prototype.increment = function () {
					this.enemy.increment();
			};

			SpaceInvaders.prototype.complete = function () {
					this.completed = true;
			};
			return SpaceInvaders;
	})();
	Games.SpaceInvaders = SpaceInvaders;
})(Games || (Games = {}));

var Players;
(function (Players) {
	var Player = (function () {
			function Player(game, position, spriteurl) {
					var _this = this;
					this.position = position;
					this.sprite = this.loadImage(spriteurl);
					this.speed = 5;

					this.dropHeight = 48;

					this.targetEdge = 0;

					this.width = 32;
					this.height = 32;
					this.padding = 20;

					this.game = game;

					this.dead = false;

					document.addEventListener("keydown", function (ev) {
							return _this.keyInput(ev);
					});
			}
			Player.prototype.update = function () {
					var hit0 = false;
					var hit1 = false;

					if ((this.position.x - (this.width / 2)) - this.padding < 0) {
							this.position.x = (this.width / 2) + this.padding;
							hit0 = true;
					} else if ((this.position.x + (this.width / 2)) + this.padding >= 500) {
							this.position.x = 500 - (this.width / 2) - this.padding;
							hit1 = true;
					}

					if (hit0 && this.targetEdge < 1) {
							this.position.y += this.dropHeight;
							this.targetEdge = 1;
							this.game.increment();
					}

					if (hit1 && this.targetEdge > -1) {
							this.position.y += this.dropHeight;
							this.targetEdge = -1;
							this.game.increment();
					}

					if (this.position.y + (this.height / 2) > 500 - this.dropHeight) {
							this.game.complete();
					}
			};

			Player.prototype.draw = function (ctx) {
					ctx.drawImage(this.sprite, this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
			};

			Player.prototype.keyInput = function (event) {
					switch (event.keyCode) {
							case 87:
							case 119:
									break;
							case 65:
							case 97:
									this.position.x -= this.speed;
									break;
							case 83:
							case 115:
									break;
							case 68:
							case 100:
									this.position.x += this.speed;
									break;
							default:
									break;
					}
			};

			Player.prototype.getpos = function () {
					return this.position;
			};

			Player.prototype.getdead = function () {
					return this.dead;
			};

			Player.prototype.boundingbox = function () {
					return new Area.RectArea(this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
			};

			Player.prototype.hit = function () {
					this.dead = true;
			};

			Player.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Player;
	})();
	Players.Player = Player;
})(Players || (Players = {}));

var Enemies;
(function (Enemies) {
	var Tank = (function () {
			function Tank(game, position, player, spriteurl) {
					this.game = game;
					this.player = player;
					this.position = position;
					this.sprite = this.loadImage(spriteurl);
					this.speed = 0.01;

					this.bullet = null;
			}
			Tank.prototype.update = function () {
					this.position.x = Maths.lerp(this.position.x, this.player.getpos().x, this.speed);

					if (this.bullet == null && Math.abs(this.position.x - this.player.getpos().x) < 100) {
							var targets = [];
							targets.push(this.player);

							this.bullet = new Projectile.Bullet(new Vectors.Vector2D(this.position.x, this.position.y - 5), new Vectors.Vector2D(0, -1), 3.0, targets);
					}

					if (this.bullet != null) {
							this.bullet.update();

							if (this.bullet.hit || this.bullet.getpos().y < 0) {
									this.bullet = null;
							}
					}
			};

			Tank.prototype.draw = function (ctx) {
					ctx.fillStyle = "#fff";
					ctx.fillRect(this.position.x - 12.5, this.position.y - 12.5, 25, 25);

					if (this.bullet != null) {
							this.bullet.draw(ctx);
					}
			};

			Tank.prototype.increment = function () {
					this.speed += 0.005;
			};

			Tank.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Tank;
	})();
	Enemies.Tank = Tank;
})(Enemies || (Enemies = {}));

var Projectile;
(function (Projectile) {
	var Bullet = (function () {
			function Bullet(position, direction, speed, targets) {
					this.position = position;
					this.direction = direction;
					this.targets = targets;
					this.speed = speed;
					this.hit = false;

					this.emitter = new Particles.Emitter(10, 25, new Vectors.Vector2D(this.position.x, this.position.y), new Vectors.Vector2D(0, 1), "https://s.put.re/dmmTenbz.png");
			}
			Bullet.prototype.update = function () {
					this.position.x += this.direction.x * this.speed;
					this.position.y += this.direction.y * this.speed;

					this.emitter.pos = new Vectors.Vector2D(this.position.x, this.position.y);

					this.emitter.update();

					this.checkCollisions();

					this.speed += 0.05;
			};

			Bullet.prototype.checkCollisions = function () {
					var _this = this;
					this.targets.forEach(function (t) {
							var collider = t.boundingbox();

							if (collider.contains(_this.position)) {
									t.hit();
									_this.hit = true;
							}
					});
			};

			Bullet.prototype.draw = function (ctx) {
					ctx.fillStyle = "#fff";
					ctx.fillRect(this.position.x, this.position.y, 2, 5);

					this.emitter.draw(ctx);
			};

			Bullet.prototype.getpos = function () {
					return this.position;
			};
			return Bullet;
	})();
	Projectile.Bullet = Bullet;
})(Projectile || (Projectile = {}));

var Particles;
(function (Particles) {
	var AreaEmitter = (function () {
			function AreaEmitter(minPartices, maxParticles, area, imagesrc) {
					if (typeof imagesrc === "undefined") { imagesrc = ""; }
					this.area = new Area.RectArea(area.x, area.y, area.width, area.height);

					this.minParticles = minPartices;
					this.maxParticles = maxParticles;

					this.particles = [];

					if (imagesrc != "") {
							this.image = this.loadImage(imagesrc);
					} else {
							this.image = null;
					}
			}
			AreaEmitter.prototype.addparticle = function () {
					this.particles.push(new Particle(this.area.getPoint(), new Vectors.Vector2D(0, 1), 2500, 5000, 5, 7.5, 7.5, 10, 20, 20, 20, 20, this.image));
			};

			AreaEmitter.prototype.update = function () {
					var _this = this;
					if (this.particles.length < this.maxParticles) {
							this.addparticle();
					}

					var inactive;
					inactive = [];

					this.particles.forEach(function (p) {
							if (p.active()) {
									p.update();
							} else {
									inactive.push(p);
							}
					});

					inactive.forEach(function (i) {
							_this.particles.splice(_this.particles.indexOf(i), 1);
					});
			};

			AreaEmitter.prototype.draw = function (ctx) {
					//console.log(this.particles.length);
					this.particles.forEach(function (p) {
							console.log(p);

							p.draw(ctx);
					});
			};

			AreaEmitter.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return AreaEmitter;
	})();
	Particles.AreaEmitter = AreaEmitter;

	var Emitter = (function () {
			function Emitter(minPartices, maxParticles, pos, emitDir, imagesrc) {
					if (typeof imagesrc === "undefined") { imagesrc = ""; }
					this.pos = new Vectors.Vector2D(pos.x, pos.y);
					this.dir = new Vectors.Vector2D(0, 0);

					emitDir.normalize();
					this.emitDir = emitDir;

					this.minParticles = minPartices;
					this.maxParticles = maxParticles;

					this.particles = [];

					if (imagesrc != "") {
							this.image = this.loadImage(imagesrc);
					} else {
							this.image = null;
					}
			}
			Emitter.prototype.addparticle = function () {
					this.particles.push(new Particle(new Vectors.Vector2D(this.pos.x, this.pos.y), new Vectors.Vector2D(this.emitDir.x + (Math.random() * 2 - 1), this.emitDir.y + (Math.random() * 2 - 1)), 500, 1000, 0.5, 1.0, 0.1, 0.2, 1, 5, 3, 8, this.image));
			};

			Emitter.prototype.update = function () {
					var _this = this;
					if (this.particles.length < this.maxParticles) {
							this.addparticle();
					}

					var inactive;
					inactive = [];

					this.particles.forEach(function (p) {
							if (p.active()) {
									p.update();
							} else {
									inactive.push(p);
							}
					});

					inactive.forEach(function (i) {
							_this.particles.splice(_this.particles.indexOf(i), 1);
					});
			};

			Emitter.prototype.draw = function (ctx) {
					this.particles.forEach(function (p) {
							p.draw(ctx);
					});
			};

			Emitter.prototype.loadImage = function (src) {
					var img = new Image();
					img.src = src;

					return img;
			};
			return Emitter;
	})();
	Particles.Emitter = Emitter;

	var Particle = (function () {
			function Particle(pos, dir, minlifespan, maxlifespan, minstartspeed, maxstartspeed, minendspeed, maxendspeed, minstartsize, maxstartsize, minendsize, maxendsize, img) {
					if (typeof img === "undefined") { img = null; }
					this.pos = pos;

					dir.normalize();
					this.dir = dir;

					this.spawned = new Date().getTime();
					this.lifespan = Maths.lerp(minlifespan, maxlifespan, Math.random());

					this.startspeed = Maths.lerp(minstartspeed, maxstartspeed, Math.random());
					this.endspeed = Maths.lerp(minendspeed, maxendspeed, Math.random());

					this.startsize = Maths.lerp(minstartsize, maxstartsize, Math.random());
					this.endsize = Maths.lerp(minendsize, maxendsize, Math.random());

					this.image = img;
			}
			Particle.prototype.active = function () {
					return this.age() < 1;
			};

			Particle.prototype.update = function () {
					this.pos.x += this.dir.x * Maths.lerp(this.startspeed, this.endspeed, this.age());
					this.pos.y += this.dir.y * Maths.lerp(this.startspeed, this.endspeed, this.age());
			};

			Particle.prototype.draw = function (ctx) {
					var currentsize = Maths.lerp(this.startsize, this.endsize, this.age());
					var offset = currentsize / 2;

					if (this.image == null) {
							ctx.fillRect(this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
					} else {
							ctx.drawImage(this.image, this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
					}
			};

			Particle.prototype.age = function () {
					var timeactive = new Date().getTime() - this.spawned;
					return timeactive / this.lifespan;
			};
			return Particle;
	})();
	Particles.Particle = Particle;
})(Particles || (Particles = {}));

var Area;
(function (Area) {
	var LineArea = (function () {
			function LineArea(from, to) {
					this.from = from;
					this.to = to;
			}
			LineArea.prototype.contains = function (v0) {
					return true;
			};

			LineArea.prototype.getPoint = function () {
					return new Vectors.Vector2D(0, 0);
			};
			return LineArea;
	})();
	Area.LineArea = LineArea;

	var RectArea = (function () {
			function RectArea(x, y, width, height) {
					this.x = x;
					this.y = y;
					this.width = width;
					this.height = height;
			}
			RectArea.prototype.contains = function (v0) {
					if (v0.x < this.x)
							return false;
					if (v0.y < this.y)
							return false;
					if (v0.x > this.x + this.width)
							return false;
					if (v0.y > this.y + this.height)
							return false;

					return true;
			};

			RectArea.prototype.getPoint = function () {
					return new Vectors.Vector2D(Maths.lerp(this.x, this.x + this.width, Math.random()), Maths.lerp(this.y, this.y + this.height, Math.random()));
			};
			return RectArea;
	})();
	Area.RectArea = RectArea;
})(Area || (Area = {}));

var Vectors;
(function (Vectors) {
	var Vector2D = (function () {
			function Vector2D(x, y) {
					this.x = x;
					this.y = y;
					this.x = x;
					this.y = y;
			}
			Vector2D.prototype.length = function () {
					return Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2));
			};

			Vector2D.prototype.normalize = function () {
					var length = this.length();

					this.x = this.x / length;
					this.y = this.y / length;
			};

			Vector2D.Add = function (v0, v1) {
					return new Vector2D(v0.x + v1.x, v0.y + v1.y);
			};

			Vector2D.Multiply = function (v0, v) {
					return new Vector2D(v0.x * v, v0.y * v);
			};

			Vector2D.Lerp = function (v0, v1, amount) {
					return Vector2D.Add(v1, Vector2D.Multiply(new Vector2D(v1.x - v0.x, v1.y - v0.y), amount));
			};
			return Vector2D;
	})();
	Vectors.Vector2D = Vector2D;
})(Vectors || (Vectors = {}));

var Maths = (function () {
	function Maths() {
	}
	Maths.lerp = function (v0, v1, t) {
			return v0 + (v1 - v0) * t;
	};
	return Maths;
})();
//@ sourceMappingURL=particle.js.map
//codepen.io/daniel-j-lewis/pen/HmxzJ
window.onload = function () {
var g = new Games.SpaceInvaders();
};

var Games;
(function (Games) {
var SpaceInvaders = (function () {
		//private testEmitter: Particles.Emitter;
		//private testEmitter2: Particles.Emitter;
		//private areaEmitter: Particles.AreaEmitter;
		function SpaceInvaders() {
				this.initialize();
		}
		SpaceInvaders.prototype.initialize = function () {
				var _this = this;
				this.canvas = document.getElementById("canvas");

				this.player = new Players.Player(this, new Vectors.Vector2D(234, 20), "https://s.put.re/3Xep9w2i.png");
				this.enemy = new Enemies.Tank(this, new Vectors.Vector2D(20, 450), this.player, "");

				this.completed = false;

				this.drawToken = setInterval(function () {
						return _this.draw();
				}, 25);
				this.updateToken = setInterval(function () {
						return _this.update();
				}, 25);
		};

		SpaceInvaders.prototype.update = function () {
				//this.testEmitter.update();
				//this.testEmitter2.update();
				//this.areaEmitter.update();
				this.player.update();
				this.enemy.update();
		};

		SpaceInvaders.prototype.draw = function () {
				var ctx;
				ctx = this.canvas.getContext("2d");
				ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

				ctx.fillStyle = "#000";
				ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

				if (this.completed) {
						ctx.fillStyle = "#fff";
						ctx.fillText("complete", 200, 200);
				} else if (this.player.getdead()) {
						ctx.fillStyle = "#f00";
						ctx.fillText("game over", 200, 200);
				} else {
						this.player.draw(ctx);
						this.enemy.draw(ctx);
				}
		};

		SpaceInvaders.prototype.increment = function () {
				this.enemy.increment();
		};

		SpaceInvaders.prototype.complete = function () {
				this.completed = true;
		};
		return SpaceInvaders;
})();
Games.SpaceInvaders = SpaceInvaders;
})(Games || (Games = {}));

var Players;
(function (Players) {
var Player = (function () {
		function Player(game, position, spriteurl) {
				var _this = this;
				this.position = position;
				this.sprite = this.loadImage(spriteurl);
				this.speed = 5;

				this.dropHeight = 48;

				this.targetEdge = 0;

				this.width = 32;
				this.height = 32;
				this.padding = 20;

				this.game = game;

				this.dead = false;

				document.addEventListener("keydown", function (ev) {
						return _this.keyInput(ev);
				});
		}
		Player.prototype.update = function () {
				var hit0 = false;
				var hit1 = false;

				if ((this.position.x - (this.width / 2)) - this.padding < 0) {
						this.position.x = (this.width / 2) + this.padding;
						hit0 = true;
				} else if ((this.position.x + (this.width / 2)) + this.padding >= 500) {
						this.position.x = 500 - (this.width / 2) - this.padding;
						hit1 = true;
				}

				if (hit0 && this.targetEdge < 1) {
						this.position.y += this.dropHeight;
						this.targetEdge = 1;
						this.game.increment();
				}

				if (hit1 && this.targetEdge > -1) {
						this.position.y += this.dropHeight;
						this.targetEdge = -1;
						this.game.increment();
				}

				if (this.position.y + (this.height / 2) > 500 - this.dropHeight) {
						this.game.complete();
				}
		};

		Player.prototype.draw = function (ctx) {
				ctx.drawImage(this.sprite, this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
		};

		Player.prototype.keyInput = function (event) {
				switch (event.keyCode) {
						case 87:
						case 119:
								break;
						case 65:
						case 97:
								this.position.x -= this.speed;
								break;
						case 83:
						case 115:
								break;
						case 68:
						case 100:
								this.position.x += this.speed;
								break;
						default:
								break;
				}
		};

		Player.prototype.getpos = function () {
				return this.position;
		};

		Player.prototype.getdead = function () {
				return this.dead;
		};

		Player.prototype.boundingbox = function () {
				return new Area.RectArea(this.position.x - (this.width / 2), this.position.y - (this.height / 2), this.width, this.height);
		};

		Player.prototype.hit = function () {
				this.dead = true;
		};

		Player.prototype.loadImage = function (src) {
				var img = new Image();
				img.src = src;

				return img;
		};
		return Player;
})();
Players.Player = Player;
})(Players || (Players = {}));

var Enemies;
(function (Enemies) {
var Tank = (function () {
		function Tank(game, position, player, spriteurl) {
				this.game = game;
				this.player = player;
				this.position = position;
				this.sprite = this.loadImage(spriteurl);
				this.speed = 0.01;

				this.bullet = null;
		}
		Tank.prototype.update = function () {
				this.position.x = Maths.lerp(this.position.x, this.player.getpos().x, this.speed);

				if (this.bullet == null && Math.abs(this.position.x - this.player.getpos().x) < 100) {
						var targets = [];
						targets.push(this.player);

						this.bullet = new Projectile.Bullet(new Vectors.Vector2D(this.position.x, this.position.y - 5), new Vectors.Vector2D(0, -1), 3.0, targets);
				}

				if (this.bullet != null) {
						this.bullet.update();

						if (this.bullet.hit || this.bullet.getpos().y < 0) {
								this.bullet = null;
						}
				}
		};

		Tank.prototype.draw = function (ctx) {
				ctx.fillStyle = "#fff";
				ctx.fillRect(this.position.x - 12.5, this.position.y - 12.5, 25, 25);

				if (this.bullet != null) {
						this.bullet.draw(ctx);
				}
		};

		Tank.prototype.increment = function () {
				this.speed += 0.005;
		};

		Tank.prototype.loadImage = function (src) {
				var img = new Image();
				img.src = src;

				return img;
		};
		return Tank;
})();
Enemies.Tank = Tank;
})(Enemies || (Enemies = {}));

var Projectile;
(function (Projectile) {
var Bullet = (function () {
		function Bullet(position, direction, speed, targets) {
				this.position = position;
				this.direction = direction;
				this.targets = targets;
				this.speed = speed;
				this.hit = false;

				this.emitter = new Particles.Emitter(10, 25, new Vectors.Vector2D(this.position.x, this.position.y), new Vectors.Vector2D(0, 1), "https://s.put.re/dmmTenbz.png");
		}
		Bullet.prototype.update = function () {
				this.position.x += this.direction.x * this.speed;
				this.position.y += this.direction.y * this.speed;

				this.emitter.pos = new Vectors.Vector2D(this.position.x, this.position.y);

				this.emitter.update();

				this.checkCollisions();

				this.speed += 0.05;
		};

		Bullet.prototype.checkCollisions = function () {
				var _this = this;
				this.targets.forEach(function (t) {
						var collider = t.boundingbox();

						if (collider.contains(_this.position)) {
								t.hit();
								_this.hit = true;
						}
				});
		};

		Bullet.prototype.draw = function (ctx) {
				ctx.fillStyle = "#fff";
				ctx.fillRect(this.position.x, this.position.y, 2, 5);

				this.emitter.draw(ctx);
		};

		Bullet.prototype.getpos = function () {
				return this.position;
		};
		return Bullet;
})();
Projectile.Bullet = Bullet;
})(Projectile || (Projectile = {}));

var Particles;
(function (Particles) {
var AreaEmitter = (function () {
		function AreaEmitter(minPartices, maxParticles, area, imagesrc) {
				if (typeof imagesrc === "undefined") { imagesrc = ""; }
				this.area = new Area.RectArea(area.x, area.y, area.width, area.height);

				this.minParticles = minPartices;
				this.maxParticles = maxParticles;

				this.particles = [];

				if (imagesrc != "") {
						this.image = this.loadImage(imagesrc);
				} else {
						this.image = null;
				}
		}
		AreaEmitter.prototype.addparticle = function () {
				this.particles.push(new Particle(this.area.getPoint(), new Vectors.Vector2D(0, 1), 2500, 5000, 5, 7.5, 7.5, 10, 20, 20, 20, 20, this.image));
		};

		AreaEmitter.prototype.update = function () {
				var _this = this;
				if (this.particles.length < this.maxParticles) {
						this.addparticle();
				}

				var inactive;
				inactive = [];

				this.particles.forEach(function (p) {
						if (p.active()) {
								p.update();
						} else {
								inactive.push(p);
						}
				});

				inactive.forEach(function (i) {
						_this.particles.splice(_this.particles.indexOf(i), 1);
				});
		};

		AreaEmitter.prototype.draw = function (ctx) {
				//console.log(this.particles.length);
				this.particles.forEach(function (p) {
						console.log(p);

						p.draw(ctx);
				});
		};

		AreaEmitter.prototype.loadImage = function (src) {
				var img = new Image();
				img.src = src;

				return img;
		};
		return AreaEmitter;
})();
Particles.AreaEmitter = AreaEmitter;

var Emitter = (function () {
		function Emitter(minPartices, maxParticles, pos, emitDir, imagesrc) {
				if (typeof imagesrc === "undefined") { imagesrc = ""; }
				this.pos = new Vectors.Vector2D(pos.x, pos.y);
				this.dir = new Vectors.Vector2D(0, 0);

				emitDir.normalize();
				this.emitDir = emitDir;

				this.minParticles = minPartices;
				this.maxParticles = maxParticles;

				this.particles = [];

				if (imagesrc != "") {
						this.image = this.loadImage(imagesrc);
				} else {
						this.image = null;
				}
		}
		Emitter.prototype.addparticle = function () {
				this.particles.push(new Particle(new Vectors.Vector2D(this.pos.x, this.pos.y), new Vectors.Vector2D(this.emitDir.x + (Math.random() * 2 - 1), this.emitDir.y + (Math.random() * 2 - 1)), 500, 1000, 0.5, 1.0, 0.1, 0.2, 1, 5, 3, 8, this.image));
		};

		Emitter.prototype.update = function () {
				var _this = this;
				if (this.particles.length < this.maxParticles) {
						this.addparticle();
				}

				var inactive;
				inactive = [];

				this.particles.forEach(function (p) {
						if (p.active()) {
								p.update();
						} else {
								inactive.push(p);
						}
				});

				inactive.forEach(function (i) {
						_this.particles.splice(_this.particles.indexOf(i), 1);
				});
		};

		Emitter.prototype.draw = function (ctx) {
				this.particles.forEach(function (p) {
						p.draw(ctx);
				});
		};

		Emitter.prototype.loadImage = function (src) {
				var img = new Image();
				img.src = src;

				return img;
		};
		return Emitter;
})();
Particles.Emitter = Emitter;

var Particle = (function () {
		function Particle(pos, dir, minlifespan, maxlifespan, minstartspeed, maxstartspeed, minendspeed, maxendspeed, minstartsize, maxstartsize, minendsize, maxendsize, img) {
				if (typeof img === "undefined") { img = null; }
				this.pos = pos;

				dir.normalize();
				this.dir = dir;

				this.spawned = new Date().getTime();
				this.lifespan = Maths.lerp(minlifespan, maxlifespan, Math.random());

				this.startspeed = Maths.lerp(minstartspeed, maxstartspeed, Math.random());
				this.endspeed = Maths.lerp(minendspeed, maxendspeed, Math.random());

				this.startsize = Maths.lerp(minstartsize, maxstartsize, Math.random());
				this.endsize = Maths.lerp(minendsize, maxendsize, Math.random());

				this.image = img;
		}
		Particle.prototype.active = function () {
				return this.age() < 1;
		};

		Particle.prototype.update = function () {
				this.pos.x += this.dir.x * Maths.lerp(this.startspeed, this.endspeed, this.age());
				this.pos.y += this.dir.y * Maths.lerp(this.startspeed, this.endspeed, this.age());
		};

		Particle.prototype.draw = function (ctx) {
				var currentsize = Maths.lerp(this.startsize, this.endsize, this.age());
				var offset = currentsize / 2;

				if (this.image == null) {
						ctx.fillRect(this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
				} else {
						ctx.drawImage(this.image, this.pos.x - offset, this.pos.y - offset, currentsize, currentsize);
				}
		};

		Particle.prototype.age = function () {
				var timeactive = new Date().getTime() - this.spawned;
				return timeactive / this.lifespan;
		};
		return Particle;
})();
Particles.Particle = Particle;
})(Particles || (Particles = {}));

var Area;
(function (Area) {
var LineArea = (function () {
		function LineArea(from, to) {
				this.from = from;
				this.to = to;
		}
		LineArea.prototype.contains = function (v0) {
				return true;
		};

		LineArea.prototype.getPoint = function () {
				return new Vectors.Vector2D(0, 0);
		};
		return LineArea;
})();
Area.LineArea = LineArea;

var RectArea = (function () {
		function RectArea(x, y, width, height) {
				this.x = x;
				this.y = y;
				this.width = width;
				this.height = height;
		}
		RectArea.prototype.contains = function (v0) {
				if (v0.x < this.x)
						return false;
				if (v0.y < this.y)
						return false;
				if (v0.x > this.x + this.width)
						return false;
				if (v0.y > this.y + this.height)
						return false;

				return true;
		};

		RectArea.prototype.getPoint = function () {
				return new Vectors.Vector2D(Maths.lerp(this.x, this.x + this.width, Math.random()), Maths.lerp(this.y, this.y + this.height, Math.random()));
		};
		return RectArea;
})();
Area.RectArea = RectArea;
})(Area || (Area = {}));

var Vectors;
(function (Vectors) {
var Vector2D = (function () {
		function Vector2D(x, y) {
				this.x = x;
				this.y = y;
				this.x = x;
				this.y = y;
		}
		Vector2D.prototype.length = function () {
				return Math.sqrt(Math.pow(this.x, 2) + Math.pow(this.y, 2));
		};

		Vector2D.prototype.normalize = function () {
				var length = this.length();

				this.x = this.x / length;
				this.y = this.y / length;
		};

		Vector2D.Add = function (v0, v1) {
				return new Vector2D(v0.x + v1.x, v0.y + v1.y);
		};

		Vector2D.Multiply = function (v0, v) {
				return new Vector2D(v0.x * v, v0.y * v);
		};

		Vector2D.Lerp = function (v0, v1, amount) {
				return Vector2D.Add(v1, Vector2D.Multiply(new Vector2D(v1.x - v0.x, v1.y - v0.y), amount));
		};
		return Vector2D;
})();
Vectors.Vector2D = Vector2D;
})(Vectors || (Vectors = {}));

var Maths = (function () {
function Maths() {
}
Maths.lerp = function (v0, v1, t) {
		return v0 + (v1 - v0) * t;
};
return Maths;
})();
//@ sourceMappingURL=particle.js.map
//codepen.io/daniel-j-lewis/pen/HmxzJ