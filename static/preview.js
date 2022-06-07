const levelList = document.getElementsByClassName("card");
const ctx = document.createElement("canvas").getContext("2d");
const tileSheet = new Image();
tileSheet.src = "rs/tilesheet.png";
const tileSize = 16;
const sheetColumns = 5;

class Vec2 {
  constructor(x, y) {
    this.x = x ? x : 0;
    this.y = y ? y : 0;
  }
}

function drawTile(pos, sheetIndex) {
  const sheetX = (sheetIndex % sheetColumns) * tileSize;
  const sheetY = Math.floor(sheetIndex / sheetColumns) * tileSize;
  const canvasX = pos.x * tileSize;
  const canvasY = pos.y * tileSize;
  ctx.drawImage(
    tileSheet,
    sheetX,
    sheetY,
    tileSize,
    tileSize,
    canvasX,
    canvasY,
    tileSize,
    tileSize
  );
}

function drawFloor(data, mapWidth, index, pos) {
  if (
    data[index - 1] >= -1 &&
    data[index + 1] >= -1 &&
    data[index - mapWidth] >= -1 &&
    data[index + mapWidth] >= -1
  ) {
    this.drawTile(pos, 5);
  } else {
    this.drawTile(pos, 0);
  }
}

function drawMap(data, mapWidth) {
  data.forEach((value, index) => {
    const pos = new Vec2(
      (index % mapWidth) + 1,
      Math.floor(index / mapWidth) + 1
    );
    switch (value) {
      case -3: // floor
        {
          this.drawFloor(data, mapWidth, index, pos);
        }
        break;
      case -2: // wall
        {
          this.drawTile(pos, 2);
        }
        break;
      case -1: //ice
        {
          this.drawTile(pos, 1);
        }
        break;
      case 0: //rock
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 20);
        }
        break;
      case 1: //up
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 17);
        }
        break;
      case 2: // left
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 16);
        }
        break;
      case 3: // down
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 22);
        }
        break;
      case 4: // right
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 21);
        }
        break;
      case 5: // breaking
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 23);
        }
        break;
      case 6: // breaked
        {
          this.drawTile(pos, 1);
          this.drawTile(pos, 24);
        }
        break;
      default:
        break;
    }
  });
}

function drawWall(mapWidth, mapHeight) {
  for (let x = 1; x <= mapWidth; x++) {
    this.drawTile(new Vec2(x, 0), 2);
    this.drawTile(new Vec2(x, mapHeight + 1), 7);
  }
  for (let y = 1; y <= mapHeight; y++) {
    this.drawTile(new Vec2(0, y), 8);
    this.drawTile(new Vec2(mapWidth + 1, y), 9);
  }
  this.drawTile(new Vec2(0, 0), 3);
  this.drawTile(new Vec2(mapWidth + 1, 0), 4);
  this.drawTile(new Vec2(0, mapHeight + 1), 13);
  this.drawTile(new Vec2(mapWidth + 1, mapHeight + 1), 14);
}

tileSheet.onload = () => {
  [].forEach.call(levelList, (level) => {
    const mapstr = level.getAttribute("data-map");
    level.href += `?map-data=${mapstr}`;
    const map = JSON.parse(mapstr);
    ctx.canvas.width = (map.width + 2) * tileSize;
    ctx.canvas.height = (map.height + 2) * tileSize;
    drawWall(map.width, map.height);
    drawMap(map.data, map.width);
    level.children[0].src = ctx.canvas.toDataURL();
  });
};

const right = document.getElementById("right_arrow");
const left = document.getElementById("left_arrow");
const level_list = document.getElementById("level_list");

level_list.addEventListener("scroll", (e) => {
  if (e.target.scrollLeft > 0) {
    left.style.opacity = 1;
  } else {
    left.style.opacity = 0;
  }
  if (e.target.scrollLeft < e.target.scrollWidth - e.target.clientWidth) {
    right.style.opacity = 1;
  } else {
    right.style.opacity = 0;
  }
});

right.addEventListener("click", () => {
  level_list.scrollTo({
    left: level_list.scrollLeft + level_list.clientWidth,
    behavior: "smooth",
  });
});

left.addEventListener("click", () => {
  level_list.scrollTo({
    left: level_list.scrollLeft - level_list.clientWidth,
    behavior: "smooth",
  });
});
