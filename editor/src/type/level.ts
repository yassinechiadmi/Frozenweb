type Level = {
    header: {
        width: number,
        height: number,
        diff: number,
    },
    body: {
        texture: number[],
        data: number[],
        start: { x: number, y: number },
        end: { x: number, y: number },
    },
}

